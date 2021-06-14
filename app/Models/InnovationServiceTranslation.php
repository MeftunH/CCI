<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InnovationServiceTranslation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function innovation()
    {
        return $this->belongsTo(InnovationService::class);
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'id');
    }
}
