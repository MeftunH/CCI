<?php


namespace App\Actions\Subscribers;


use App\Models\Subscriber;

class UnSubscribeAction
{
    public function __construct()
    {

    }

    public function run($token)
    {
        $subscriber = Subscriber::where('token',$token)->subscribed()->firstOrFail();
        $subscriber->subscribed = false;
        return $subscriber->save();
    }

}
