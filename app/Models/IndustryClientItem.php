<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class IndustryClientItem extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function translations()
    {
        return $this->hasMany(IndustryClientItemTranslation::class)->join('languages',function ($q)
        {
            $q->on('industry_client_item_translations.language_id','=','languages.id');
        });
    }


    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('industry_client_item_translations','item_id','industry_client_items.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->select('industry_client_item_translations.*',
                'languages.id as lang_id'
            )->paginate(4);
    }


    public function scopeGetData($query,$currentLang)
    {
        return $query
            ->join('industry_client_item_translations','item_id','industry_client_items.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }

    public function scopeGet_first($query)
    {
        return $query->first();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('industry_client_item_translations','industry_client_item_translations.item_id','industry_client_items.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('industry_client_item_translations','item_id','industry_client_items.id')
            ->join('languages','language_id','languages.id')->where('industry_client_item_translations.item_id',$id)->first();
    }
}
