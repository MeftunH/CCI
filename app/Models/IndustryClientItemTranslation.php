<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryClientItemTranslation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function industryClientItem()
    {
        return $this->belongsTo(IndustryClientItem::class);
    }
    public function scopeLocalizedData($query)
    {
        return $query->where('language_locale',app()->getLocale())->first();
    }
}
