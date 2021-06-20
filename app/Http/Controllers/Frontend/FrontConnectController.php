<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ConnectIntro;
use Illuminate\Http\Request;

class FrontConnectController extends Controller
{
    public function index()
    {
        $intro = ConnectIntro::languages(app()->getLocale())->first();
        return view('pages.connect', compact('intro'));
    }
}
