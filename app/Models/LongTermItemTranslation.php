<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LongTermItemTranslation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function longTermItem()
    {
        return $this->$this->belongsTo(LongTermItem::class);
    }
}
