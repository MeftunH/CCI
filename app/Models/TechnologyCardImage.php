<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnologyCardImage extends Model
{
    use HasFactory;
    protected $fillable=['big_image','background_image'];
}
