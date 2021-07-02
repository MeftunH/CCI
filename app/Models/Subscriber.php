<?php

namespace App\Models;

use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model implements HasLocalePreference
{
    use HasFactory;

    public function preferredLocale()
    {
        return $this->locale;
    }
    protected $fillable = ['email','locale','token'];

    public function scopeSubscribed($query)
    {
        return $query->where('subscribed',true);
    }

}
