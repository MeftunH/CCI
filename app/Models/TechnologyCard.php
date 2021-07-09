<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TechnologyCard extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function translations()
    {
        return $this->hasMany(TechnologyCardTranslation::class);

    }
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('technology_card_translations','card_id','technology_cards.id')
            ->join('languages','language_id','languages.id')
            ->select('technology_card_translations.*','technology_cards.image')->where('languages.locale',$currentLang)->get();
    }
    public function scopeSearch($query,$currentLang,$search)
    {
        return $query
            ->join('technology_card_translations','card_id','technology_cards.id')
            ->join('languages','language_id','languages.id')
            ->select('technology_card_translations.*','technology_cards.image')->where('languages.locale',$currentLang)
            ->where('news_translations.title', 'LIKE', "%{$search}%")->get();
    }
    public function scopePagination($query,$currentLang)
    {
        return $query
            ->join('technology_card_translations','card_id','technology_cards.id')
            ->join('languages','language_id','languages.id')
            ->select('technology_card_translations.*','technology_cards.image')->where('languages.locale',$currentLang)->orderBy('news.id','desc')->where('news.status',1)->paginate(5);
    }
    public function scopeLang($query)
    {
        return $query
            ->join('technology_card_translations','card_id','technology_cards.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('technology_card_translations','card_id','technology_cards.id')
            ->join('languages','language_id','languages.id')->where('technology_card_translations.card_id',$id)->first();
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
    public function replace($string)
    {
        $contains = str_contains($string, '[');
        $span ="<span class='innovation_color'>";
        $replaced = str_replace(
            array('[', ']'),
            array("<span class"."='innovation_color'".">","</"."span".">"),
            $string
        );
        return $replaced;
    }
}
