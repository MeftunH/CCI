<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;

class LongTermItem extends Model
{
    use HasFactory;
    use PowerJoins;
    protected $guarded=[];

    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('long_term_item_translations','item_id','long_term_items.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->select('long_term_item_translations.*',
                'languages.id as lang_id'
            )->paginate(4);
    }


    public function scopeGetData($query,$currentLang)
    {
        return $query
            ->join('long_term_item_translations','item_id','long_term_items.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }

    public function translations()
    {
        return $this->hasMany(LongTermItemTranslation::class);
    }
    public function scopeGet_first($query)
    {
        return $query->first();
    }
    public function scopeLang($query)
    {
        return $query
            ->join('long_term_item_translations','long_term_item_translations.item_id','long_term_items.id')
            ->join('languages','language_id','languages.id')->get();
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('long_term_item_translations','item_id','long_term_items.id')
            ->join('languages','language_id','languages.id')->where('long_term_item_translations.item_id',$id)->first();
    }
}
