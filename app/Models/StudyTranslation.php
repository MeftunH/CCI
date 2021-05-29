<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyTranslation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function study()
    {
        return $this->belongsTo(Study::class);
    }
    public function scopeLocalizedData($query)
    {
        return $query->where('language_locale',app()->getLocale())->first();
    }

}
