<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FutureTranslation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function future()
    {
        return $this->belongsTo(Future::class);
    }
    public function scopeLocalizedData($query)
    {
        return $query->where('language_locale',app()->getLocale())->first();
    }
}
