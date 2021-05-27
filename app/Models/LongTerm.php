<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kirschbaum\PowerJoins\PowerJoins;

class LongTerm extends Model
{
    use HasFactory;
    use PowerJoins;
    protected $guarded=[];
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('long_term_translations','long_term_id','long_terms.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }
    public function limit($val): string
    {
        return Str::limit($val);
    }
    public function scopeLang($query)
    {
        return $query
            ->join('long_term_translations','long_term_id','long_terms.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('long_term_translations','long_term_id','long_terms.id')
            ->join('languages','language_id','languages.id')->where('long_term_translations.long_term_id',$id)->first();
    }
    public function scopeGet_first($query)
    {
        return $query->first();
    }
}
