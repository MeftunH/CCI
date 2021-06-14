<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Industry extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function translations()
    {
        return $this->hasMany(IndustryTranslation::class);
    }
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('industry_translations','industry_id','industries.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('industry_translations','industry_id','industries.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('industry_translations','industry_id','industries.id')
            ->join('languages','language_id','languages.id')->where('industry_translations.industry_id',$id)->first();
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
