<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FutureItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope);
    }
    public function translations()
    {
        return $this->hasMany(FutureItemTranslation::class)->join('languages',function ($q)
        {
            $q->on('future_item_translations.language_id','=','languages.id');
        });
    }

    public function localized_data()
    {
        return $this->hasMany(FutureItemTranslation::class)->join('languages',function ($q)
        {
            $q->on('future_item_translations.language_id','=','languages.id');
        })->where('languages.locale',app()->getLocale());
    }
    public function limit($val): string
    {
        return Str::limit($val);
    }
}
