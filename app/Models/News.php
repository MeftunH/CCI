<?php

namespace App\Models;

use Carbon\Carbon;
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
            ->join('languages','language_id','languages.id')
            ->select('news_translations.*','news.status','news.image')->where('languages.locale',$currentLang)->get();
    }
    public function scopeSearch($query,$currentLang,$search)
    {
        return $query
            ->join('news_translations','news_id','news.id')
            ->join('languages','language_id','languages.id')
            ->select('news_translations.*','news.status','news.image')->where('languages.locale',$currentLang)
            ->where('news_translations.title', 'LIKE', "%{$search}%")->get();
    }
    public function scopePagination($query,$currentLang)
    {
        return $query
            ->join('news_translations','news_id','news.id')
            ->join('languages','language_id','languages.id')
            ->select('news_translations.*','news.status','news.image')->where('languages.locale',$currentLang)->orderBy('news.id','desc')->where('news.status',1)->paginate(5);
    }
    public function scopeGetPopularNews($query,$currentLang)
    {
        return $query
            ->join('news_translations','news_id','news.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->orderBy('news.view_count', 'desc')
            ->select('news_translations.*','news.status','news.created_at as created_at','news.image')
            ->limit(5)->get();
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

    public function scopeRead($query,$currentLang,$id)
    {
        return $query
            ->join('news_translations','news_id','news.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->where('news_translations.news_id',$id);
    }
    public function limit($val): string
    {
        $val = preg_replace("/<img[^>]+\>/i", "(image) ", $val);
        $val = Str::limit($val);
        return $val;
    }

    public function scopeGet_first($query)
    {
        return $query->first();
    }
}
