<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class InnovationServiceItem extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function translations()
    {
        return $this->hasMany(InnovationServiceItemTranslation::class)->join('languages',function ($q)
        {
            $q->on('innovation_service_item_translations.language_id','=','languages.id');
        });
    }
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('innovation_service_item_translations','item_id','innovation_service_items.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)
            ->select('innovation_service_item_translations.*','innovation_service_items.status','innovation_service_items.image')->get();
    }
    public function scopeGetOnlyActiveItems($query,$currentLang)
    {
        return $query
            ->join('innovation_service_item_translations','item_id','innovation_service_items.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->select('innovation_service_item_translations.*','innovation_service_items.status','innovation_service_items.image')
            ->where('innovation_service_items.status',1)->get();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('innovation_service_item_translations','item_id','innovation_service_items.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('innovation_service_item_translations','item_id','innovation_service_items.id')
            ->join('languages','language_id','languages.id')->where('innovation_service_item_translations.item_id',$id)->get();
    }
    public function localized_data(): HasMany
    {
        return $this->hasMany(IndustryExperienceTranslation::class)->join('languages',function ($q)
        {
            $q->on('innovation_service_item_translations.language_id','=','languages.id');
        })->where('languages.locale',app()->getLocale());
    }
    public function getActiveCards()
    {
        return $this->hasMany(IndustryExperienceTranslation::class)->join('languages',function ($q)
        {
            $q->on('innovation_service_item_translations.language_id','=','languages.id');
        })->where('languages.locale',app()->getLocale())->where('status',1);
    }
    public function limit($val): string
    {
        return Str::limit($val);
    }

    public function scopeLimited_items($query,$currentLang)
    {
        return $query
            ->join('innovation_service_item_translations','item_id','innovation_service_items.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)
            ->where('innovation_service_items.status','1')
            ->select('innovation_service_item_translations.*','innovation_service_items.status','innovation_service_items.image')
            ->orderBy('id','desc')->take(2)->get();
    }
    public function scopeRow_items($query,$currentLang)
    {
        return $query
            ->join('innovation_service_item_translations','item_id','innovation_service_items.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)
            ->where('innovation_service_items.status','1')
            ->select('innovation_service_item_translations.*','innovation_service_items.status','innovation_service_items.image')
            ->orderBy('id','desc')->skip(2)->take(4)->get();
    }
}
