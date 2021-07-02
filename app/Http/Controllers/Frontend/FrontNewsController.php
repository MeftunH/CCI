<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\News;
use App\Models\NewsIntro;
use Illuminate\Http\Request;

class FrontNewsController extends Controller
{

    public function index()
    {
        $intro = NewsIntro::languages(app()->getLocale())->first();
        $news = News::pagination(app()->getLocale());

        $popular_posts = News::getPopularNews(app()->getLocale());

        return view('pages.news.news', compact('intro','news','popular_posts'));
    }
    public function read_more($id)
    {
        $news = News::read(app()->getLocale(),$id)->first();
        $news->increment('view_count', 1);
        $album = Image::where('news_id',$id)->get();
        return view('pages.news.read_more',compact('news','album'));
    }
    public function search(Request $request){
        $search = $request->input('search');

        $posts = News::search(app()->getLocale(),$search);

        return view('pages.news.search', compact('posts','posts'));
    }
}
