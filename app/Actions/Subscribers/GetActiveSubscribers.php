<?php


namespace App\Actions\Subscribers;


use App\Models\Subscriber;

class GetActiveSubscribers
{
    public function __construct()
    {
    }

    public function run()
    {

        return Subscriber::subscribed()->get();

    }
}
