<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function translations()
    {
        return $this->hasMany(NewsTranslation::class);

    }
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('news_translations','news_id','news.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)
            ->select('news_translations.*','news.status','news.image')->get();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('news_translations','news_id','news.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('news_translations','news_id','news.id')
            ->join('languages','language_id','languages.id')->where('news_translations.news_id',$id)->first();
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
