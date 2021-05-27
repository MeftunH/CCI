<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationalTranslation extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function operational()
    {
        return $this->belongsTo(Operational::class);
    }
    public function scopeLocalizedData($query)
    {
        return $query->where('language_locale',app()->getLocale())->first();
    }
}
