<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerConsultingItem extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('career_consulting_item_translations','item_id','career_consulting_items.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->select('career_consulting_item_translations.*',
                'languages.id as lang_id','status'
            );
    }


    public function scopeGetData($query,$currentLang)
    {
        return $query
            ->join('career_consulting_item_translations','item_id','career_consulting_items.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }

    public function translations()
    {
        return $this->hasMany(CareerConsultingItemTranslation::class);
    }
    public function scopeGet_first($query)
    {
        return $query->first();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('career_consulting_item_translations','career_consulting_item_translations.item_id','career_consulting_items.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('career_consulting_item_translations','item_id','career_consulting_items.id')
            ->join('languages','language_id','languages.id')->where('career_consulting_item_translations.item_id',$id)->first();
    }
}
