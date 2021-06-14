<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InnovationService extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function translations()
    {
        return $this->hasMany(ServiceTranslation::class);
    }
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('innovation_service_translations','innovation_id','innovation_services.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('innovation_service_translations','innovation_id','innovation_services.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('innovation_service_translations','innovation_id','innovation_services.id')
            ->join('languages','language_id','languages.id')->where('innovation_service_translations.innovation_id',$id)->first();
    }
    public function limit($val): string
    {
        return Str::limit($val);
    }

    public function scopeGet_first($query)
    {
        return $query->first();
    }

    public function replace($string)
    {
        $contains = str_contains($string, '[');
        $span ="<span class='innovation_color innovation_color-services'>";
        $replaced = str_replace(
            array('[', ']'),
            array("<span class"."='innovation_color innovation_color-services'".">","</"."span".">"),
             $string
        );
        return $replaced;
    }
}
