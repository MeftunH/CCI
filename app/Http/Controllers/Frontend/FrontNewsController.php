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
        $news = News::languages(app()->getLocale())->where('status',1);
        return view('pages.news.news', compact('intro','news'));
    }
    public function read_more($id)
    {
        $news = News::read(app()->getLocale(),$id);
        return view('pages.news.read_more',compact('news'));
    }
}
