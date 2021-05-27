<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Operational extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function translations()
    {
        return $this->hasMany(OperationalTranslation::class)->join('languages',function ($q)
        {
            $q->on('operational_translations.language_id','=','languages.id');
        });
    }

    public function localized_data()
    {
        return $this->hasMany(OperationalTranslation::class)->join('languages',function ($q)
        {
            $q->on('operational_translations.language_id','=','languages.id');
        })->where('languages.locale',app()->getLocale());
    }
    public function limit($val): string
    {
        return Str::limit($val);
    }


}
