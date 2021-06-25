<?php


namespace App\Actions\Subscribers;


use App\Models\Subscriber;
use Illuminate\Http\Request;


class StoreSubscriberAction
{
    public function __construct()
    {
    }

    public function run($request)
    {

      Subscriber::create($request);
    }

}
