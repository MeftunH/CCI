<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AcademyCareer extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('academy_career_translations','ac_id','academy_careers.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }
    public function limit($val): string
    {
        return Str::limit($val);
    }
    public function scopeLang($query)
    {
        return $query
            ->join('academy_career_translations','ac_id','academy_careers.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('academy_career_translations','ac_id','academy_careers.id')
            ->join('languages','language_id','languages.id')->where('academy_career_translations.ac_id',$id)->first();
    }
    public function scopeGet_first($query)
    {
        return $query->first();
    }
}
