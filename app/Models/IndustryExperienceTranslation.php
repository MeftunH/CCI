<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryExperienceTranslation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function industry_experiences()
    {
        return $this->belongsTo(IndustryExperience::class);
    }
    public function scopeLocalizedData($query)
    {
        return $query->where('language_locale',app()->getLocale())->first();
    }
}
