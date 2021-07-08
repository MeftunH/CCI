<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsIntro extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function translations()
    {
        return $this->hasMany(NewsIntroTranslation::class);
    }
    public function scopeLanguages($query,$currentLang)
    {
                return $query
                    ->join('news_intro_translations','intro_id','news_intros.id')
                    ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('news_intro_translations','intro_id','news_intros.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('news_intro_translations','intro_id','news_intros.id')
            ->join('languages','language_id','languages.id')->where('news_intro_translations.intro_id',$id)->first();
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
