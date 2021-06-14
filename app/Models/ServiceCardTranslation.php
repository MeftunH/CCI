<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCardTranslation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function serviceCard()
    {
        return $this->belongsTo(ServiceCard::class);
    }
    public function scopeLocalizedData($query)
    {
        return $query->where('language_locale',app()->getLocale())->first();
    }
}
