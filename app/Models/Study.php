<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Study extends Model
{
    use HasFactory;
    protected $guarded=[];



    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('study_translations','study_id','studies.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->select('study_translations.*','studies.image','studies.status','languages.locale','languages.status as lang_status');
    }
    public function scopeLang($query,$id)
    {
        return $query
            ->join('study_translations','study_id','studies.id')
            ->join('languages','language_id','languages.id')->select('study_translations.*','studies.image','studies.status','languages.locale','languages.status as lang_status')->where('study_id',$id)->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('study_translations','study_id','studies.id')
            ->join('languages','language_id','languages.id')->where('study_translations.study_id',$id)
            ->first();
    }
    public function localized_data()
    {
        return $this->hasMany(StudyTranslation::class)->join('languages',function ($q)
        {
            $q->on('study_translations.language_id','=','languages.id');
        })->where('languages.locale',app()->getLocale());
    }
    public function limit($val): string
    {
        return Str::limit($val);
    }

    public function scopeGet_first($query)
    {
        return $query->first();
    }
}
