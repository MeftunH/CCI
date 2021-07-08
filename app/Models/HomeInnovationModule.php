<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HomeInnovationModule extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function translations()
    {
        return $this->hasMany(HomeInnovationModuleTranslation::class);
    }
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('home_innovation_module_translations','intro_id','home_innovation_modules.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }
    public function scopeLanguagesFirst($query,$currentLang)
    {
        return $query
            ->join('home_innovation_module_translations','intro_id','home_innovation_modules.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->first();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('home_innovation_module_translations','intro_id','home_innovation_modules.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('home_innovation_module_translations','intro_id','home_innovation_modules.id')
            ->join('languages','language_id','languages.id')->where('home_innovation_modules.intro_id',$id)->first();
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
        $span ="<span class='innovation_color'>";
        $replaced = str_replace(
            array('[', ']'),
            array("<span class"."='innovation_color'".">","</"."span".">"),
            $string
        );
        return $replaced;
    }
}
