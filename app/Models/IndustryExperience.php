<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class IndustryExperience extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function translations()
    {
        return $this->hasMany(IndustryExperienceTranslation::class)->join('languages',function ($q)
        {
            $q->on('industry_experience_translations.language_id','=','languages.id');
        });
    }
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('industry_experience_translations','experience_id','industry_experiences.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->select('industry_experience_translations.*','industry_experiences.status','industry_experiences.image')->get();
    }
    public function scopeGetOnlyActiveItems($query,$currentLang)
    {
        return $query
            ->join('industry_experience_translations','experience_id','industry_experiences.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->select('industry_experience_translations.*','industry_experiences.status','industry_experiences.image')
            ->where('industry_experiences.status',1)->get();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('industry_experience_translations','experience_id','industry_experiences.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('industry_experience_translations','experience_id','industry_experiences.id')
            ->join('languages','language_id','languages.id')->where('industry_experience_translations.experience_id',$id)->get();
    }
    public function localized_data(): HasMany
    {
        return $this->hasMany(IndustryExperienceTranslation::class)->join('languages',function ($q)
        {
            $q->on('industry_experience_translations.language_id','=','languages.id');
        })->where('languages.locale',app()->getLocale());
    }
    public function getActiveCards()
    {
        return $this->hasMany(IndustryExperienceTranslation::class)->join('languages',function ($q)
        {
            $q->on('academy_card_translations.language_id','=','languages.id');
        })->where('languages.locale',app()->getLocale())->where('status',1);
    }
    public function limit($val): string
    {
        return Str::limit($val);
    }
}
