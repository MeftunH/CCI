<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CareerConsulting extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('career_consulting_translations','cc_id','career_consultings.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }
    public function limit($val): string
    {
        return Str::limit($val);
    }
    public function scopeLang($query)
    {
        return $query
            ->join('career_consulting_translations','cc_id','career_consultings.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('career_consulting_translations','cc_id','career_consultings.id')
            ->join('languages','language_id','languages.id')->where('career_consulting_translations.cc_id',$id)->first();
    }
    public function scopeGet_first($query)
    {
        return $query->first();
    }
}
