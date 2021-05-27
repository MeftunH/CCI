<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CaseStudy extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='case_studies';
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('case_study_translations','cs_id','case_studies.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('case_study_translations','cs_id','case_studies.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('case_study_translations','cs_id','case_studies.id')
            ->join('languages','language_id','languages.id')->where('case_study_translations.cs_id',$id)->first();
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
