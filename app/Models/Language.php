<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Language extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function aboutUs()
    {
        return $this->hasOne(AboutUsTranslation::class);
    }
    public function industry(): HasOne
    {
        return $this->hasOne(AboutUsTranslation::class);
    }
}
