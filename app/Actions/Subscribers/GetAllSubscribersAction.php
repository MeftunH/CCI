<?php


namespace App\Actions\Subscribers;




use App\Models\Subscriber;

class GetAllSubscribersAction
{
    public function __construct()
    {
    }

    public function run($perPage=10)
    {
        return Subscriber::latest()->paginate($perPage);
    }
}
