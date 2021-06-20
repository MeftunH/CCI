<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function translations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EventTranslation::class);

    }
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('event_translations','event_id','events.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)
            ->select('event_translations.*','events.status','events.image');
    }
    public function scopeLang($query)
    {
        return $query
            ->join('event_translations','event_id','events.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('event_translations','event_id','events.id')
            ->join('languages','language_id','languages.id')->where('event_translations.event_id',$id)->first();
    }

    public function scopeRead($query,$currentLang,$id)
    {
        return $query
            ->join('event_translations','event_id','events.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->where('event_translations.event_id',$id)->first();
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
