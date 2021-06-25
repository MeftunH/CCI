<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\AboutUsTranslation;
use App\Models\Future;
use App\Models\FutureItem;
use App\Models\FutureList;
use App\Models\LongTerm;
use App\Models\LongTermItem;
use App\Models\Operational;
use App\Models\TimeLine;
use App\Scopes\ActiveScope;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;

class AboutController extends Controller
{

    public function index()
    {

        $about_us = AboutUs::get_first();
        $about_us_translations = AboutUs::languages(app()->getLocale())->first();
        $long_term = LongTerm::get_first();
        $long_term_translations = LongTerm::languages(app()->getLocale())->first();
        $long_term_item = LongTermItem::get_first();
        $long_term_item_translations = LongTermItem::getData(app()->getLocale());
        $time_line = TimeLine::languages(app()->getLocale())->first();
        $time_line_translations = TimeLine::getData(app()->getLocale());
        $operational = Operational::all()->first();
        $future = Future::all()->first();
        $future_items = FutureItem::select('*')->get();
        $future_list_items = FutureList::get();
        return view('pages.about',compact('future_list_items','future_items','future','operational','time_line_translations','time_line','about_us_translations','about_us','long_term','long_term_translations','long_term_item','long_term_item_translations'));
    }
}
