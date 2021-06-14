<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademyCareerItem extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('academy_career_item_translations','item_id','academy_career_items.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->select('academy_career_item_translations.*',
                'languages.id as lang_id','status'
            );
    }


    public function scopeGetData($query,$currentLang)
    {
        return $query
            ->join('academy_career_item_translations','item_id','academy_career_items.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }

    public function translations()
    {
        return $this->hasMany(AcademyCareerItemTranslation::class);
    }
    public function scopeGet_first($query)
    {
        return $query->first();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('academy_career_item_translations','academy_career_item_translations.item_id','academy_career_items.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('academy_career_item_translations','item_id','academy_career_items.id')
            ->join('languages','language_id','languages.id')->where('academy_career_item_translations.item_id',$id)->first();
    }
}
