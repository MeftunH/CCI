<?php

namespace App\Http\Controllers\Backend;

use App\Actions\Subscribers\GetAllSubscribersAction;
use App\Actions\Subscribers\StoreSubscriberAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriberRequest;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(GetAllSubscribersAction $getAllSubscribersAction)
    {
       return view('admin.subscribers.index')->with(["subscribers"=>$getAllSubscribersAction->run()]);
    }

    public function store(Request $request,StoreSubscriberAction $storeSubscriberAction)
    {
        $data = array();
        $data['email'] = $request->get('email');
        $data['locale'] = app()->getLocale();
     $storeSubscriberAction->run($data);
     return redirect()->back();
    }
}
