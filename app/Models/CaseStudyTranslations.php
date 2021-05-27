<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudyTranslations extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function language()
    {
        return $this->belongsTo(Language::class, 'id');
    }

    public function scopeUp($query,$id,$data)
    {
        return $query
            ->where('id',$id)->update($data);
    }
}
