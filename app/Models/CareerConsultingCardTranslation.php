<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerConsultingCardTranslation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function CareerConsultingCard()
    {
        return $this->belongsTo(CareerConsultingCard::class);
    }
    public function scopeLocalizedData($query)
    {
        return $query->where('language_locale',app()->getLocale())->first();
    }
}
