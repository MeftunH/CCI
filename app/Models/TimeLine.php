<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TimeLine extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='time_line';
    public function scopeLanguages($query,$currentLang)
    {
        return $query
            ->join('time_line_translations','time_line_id','time_line.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->get();
    }
    public function limit($val): string
    {
        return Str::limit($val);
    }
    public function scopeLang($query,$id)
    {
        return $query
            ->rightjoin('time_line_translations','time_line_id','time_line.id')
            ->join('languages','language_id','languages.id')->where('time_line_id',$id)->get();
    }
    public function scopeGetData($query,$currentLang)
    {
        return $query
            ->join('time_line_translations','time_line_id','time_line.id')
            ->join('languages','language_id','languages.id')->where('languages.locale',$currentLang)->orderBy('date', 'desc')->get()->groupBy(function($date) {
                return Carbon::parse($date->date)->format('Y'); // grouping by years
                //return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });
    }
    public function scopeLangSpecificId($query,$id)
    {
        return $query
            ->join('time_line_translations','time_line_id','time_line.id')
            ->join('languages','language_id','languages.id')->where('time_line_translations.time_line_id',$id)->first();
    }
    public function scopeGet_first($query)
    {
        return $query->first();
    }
}
