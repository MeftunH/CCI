<?php


namespace App\Actions\Subscribers;


use App\Models\News;
use Illuminate\Support\Facades\Cache;

class LatestNewsAction
{
    public function __construct()
    {
    }

    public function run($locale,$limit = 10)
    {

            $news =  News::languages($locale)->take($limit);
             return $news;
    }
}
