<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApplyIntro extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function translations()
    {
        return $this->hasMany(ApplyIntroTranslation::class);
    }
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('apply_intro_translations','intro_id','apply_intros.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('apply_intro_translations','intro_id','apply_intros.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('apply_intro_translations','intro_id','apply_intros.id')
            ->join('languages','language_id','languages.id')->where('apply_intro_translations.intro_id',$id)->first();
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
