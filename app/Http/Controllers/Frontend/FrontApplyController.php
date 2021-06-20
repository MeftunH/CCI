<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ApplyIntro;
use Illuminate\Http\Request;

class FrontApplyController extends Controller
{
    public function index()
    {
        $intro = ApplyIntro::languages(app()->getLocale())->first();
//        $events = Event::languages(app()->getLocale())->where('events.status',1)->get();
        return view('pages.apply.apply', compact('intro'));
    }
}
