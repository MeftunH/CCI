<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FutureItemTranslation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function futureItem()
    {
        return $this->belongsTo(FutureItem::class);
    }
    public function scopeLocalizedData($query)
    {
        return $query->where('language_locale',app()->getLocale())->first();
    }
}
