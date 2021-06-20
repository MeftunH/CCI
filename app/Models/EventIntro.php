<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventIntro extends Model
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
            ->join('event_intro_translations','intro_id','event_intros.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('event_intro_translations','intro_id','event_intros.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('event_intro_translations','intro_id','event_intros.id')
            ->join('languages','language_id','languages.id')->where('event_intro_translations.intro_id',$id)->first();
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
