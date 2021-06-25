<?php


namespace App\Actions\Subscribers;


use App\Models\News;
use Illuminate\Support\Facades\Cache;

class LatestNewsAction
{
    public function __construct()
    {
    }

    public function run($limit = 2)
    {
        return Cache::remember('latestNews', 60 * 60 * 24, function () use ($limit) {
            return News::latest()->languages(app()->getLocale())->take($limit)->get();
        });
    }
}
