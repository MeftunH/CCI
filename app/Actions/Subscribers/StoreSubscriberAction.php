<?php


namespace App\Actions\Subscribers;


use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class StoreSubscriberAction
{
    public function __construct()
    {
    }

    public function run($request)
    {

        $request['token'] = Str::random(16);
        $existingSubscriber = Subscriber::where('email',$request['email'])->first();
        if (!$existingSubscriber)
        {
            Subscriber::create($request);

        }
        $existingSubscriber->subscribed = 1;
       return $existingSubscriber->save();
    }

}
