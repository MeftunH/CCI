<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademyCardTranslation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function academyCard()
    {
        return $this->belongsTo(AcademyCard::class);
    }
    public function scopeLocalizedData($query)
    {
        return $query->where('language_locale',app()->getLocale())->first();
    }
}
