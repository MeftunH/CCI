<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventIntro;
use Illuminate\Http\Request;

class FrontEventController extends Controller
{

    public function index()
    {
        $intro = EventIntro::languages(app()->getLocale())->first();
        $events = Event::languages(app()->getLocale())->where('events.status',1)->get();
        return view('pages.events.events', compact('intro','events'));
    }

    public function read_more($id)
    {
        $event = Event::read(app()->getLocale(),$id);
        return view('pages.events.read_more',compact('event'));
    }

}
