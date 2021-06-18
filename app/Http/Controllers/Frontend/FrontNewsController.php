<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsIntro;
use Illuminate\Http\Request;

class FrontNewsController extends Controller
{

    public function index()
    {
        $intro = NewsIntro::languages(app()->getLocale())->first();
        $news = News::languages(app()->getLocale());
        return view('pages.news', compact('intro','news'));
    }

}
