<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ServiceCard extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function translations()
    {
        return $this->hasMany(AcademyCardTranslation::class)->join('languages',function ($q)
        {
            $q->on('service_card_translations.language_id','=','languages.id');
        });
    }
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('service_card_translations','service_card_id','service_cards.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->select('service_card_translations.*','service_cards.status','service_cards.image')->get();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('service_card_translations','service_card_id','service_cards.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('service_card_translations','service_card_id','service_cards.id')
            ->join('languages','language_id','languages.id')->where('service_card_translations.service_card_id',$id)->get();
    }

    public function scopeRead($query,$currentLang,$id)
    {
        return $query
            ->join('service_card_translations','service_card_id','service_cards.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->where('service_card_translations.service_card_id',$id)->first();
    }
    public function localized_data(): HasMany
    {
        return $this->hasMany(ServiceCardTranslation::class)->join('languages',function ($q)
        {
            $q->on('service_card_translations.language_id','=','languages.id');
        })->where('languages.locale',app()->getLocale());
    }
    public function getActiveCards()
    {
        return $this->hasMany(ServiceCardTranslation::class)->join('languages',function ($q)
        {
            $q->on('service_card_translations.language_id','=','languages.id');
        })->where('languages.locale',app()->getLocale())->where('status',1);
    }
    public function limit($val): string
    {
        return Str::limit($val);
    }
}
