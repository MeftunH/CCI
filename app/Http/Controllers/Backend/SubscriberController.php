<?php

namespace App\Http\Controllers\Backend;

use App\Actions\Subscribers\GetAllSubscribersAction;
use App\Actions\Subscribers\StoreSubscriberAction;
use App\Actions\Subscribers\UnSubscribeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriberRequest;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(GetAllSubscribersAction $getAllSubscribersAction)
    {
        $subscribers = Subscriber::all();
       return view('admin.subscribers.index',compact('subscribers'));
    }

    public function store(Request $request,StoreSubscriberAction $storeSubscriberAction)
    {
        $data = array();
        $data['email'] = $request->get('email');
        $data['locale'] = app()->getLocale();
     $storeSubscriberAction->run($data);
     return redirect()->back();
    }

    public function destroy(Request $request,UnSubscribeAction $unSubscribeAction)
    {
        $unSubscribeAction->run($request->token);
        return redirect()->route('about');
    }
}
