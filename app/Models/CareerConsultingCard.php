<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CareerConsultingCard extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function translations()
    {
        return $this->hasMany(CareerConsultingCardTranslation::class)->join('languages',function ($q)
        {
            $q->on('career_consulting_card_translations.language_id','=','languages.id');
        });
    }
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('career_consulting_card_translations','cc_card_id','career_consulting_cards.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->select('career_consulting_card_translations.*','career_consulting_cards.status','career_consulting_cards.image')->get();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('career_consulting_card_translations','cc_card_id','career_consulting_cards.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('career_consulting_card_translations','cc_card_id','career_consulting_cards.id')
            ->join('languages','language_id','languages.id')->where('career_consulting_card_translations.cc_card_id',$id)->first();
    }
    public function localized_data(): HasMany
    {
        return $this->hasMany(CareerConsultingCardTranslation::class)->join('languages',function ($q)
        {
            $q->on('career_consulting_card_translations.language_id','=','languages.id');
        })->where('languages.locale',app()->getLocale());
    }
    public function getActiveCards()
    {
        return $this->hasMany(CareerConsultingCardTranslation::class)->join('languages',function ($q)
        {
            $q->on('career_consulting_card_translations.language_id','=','languages.id');
        })->where('languages.locale',app()->getLocale())->where('status',1);
    }
    public function limit($val): string
    {
        return Str::limit($val);
    }
}
