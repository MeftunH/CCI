<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomeInnovationModule;
use App\Models\HomeIntro;
use App\Models\HomeUnlockModule;
use App\Models\InnovationServiceItem;
use App\Models\Study;
use App\Models\TechnologyCardImage;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FrontHomePageController extends Controller
{
    public function index()
    {
        $intro = HomeIntro::languages(app()->getLocale())->first();
        $innovation_module = HomeInnovationModule::languagesFirst(app()->getLocale());
        $_limited_innovation_items = InnovationServiceItem::limited_items(app()->getLocale());
        $_row_innovation_items = InnovationServiceItem::row_items(app()->getLocale());
        $_last_studies = Study::languages(app()->getLocale())->where('studies.status',1)->orderBy('id','desc')->take(3)->get();
        $unlock_module = HomeUnlockModule::languagesFirst(app()->getLocale());
        $tci = TechnologyCardImage::first();
        return view('pages.index', compact('tci','intro','innovation_module','_limited_innovation_items','_row_innovation_items','_last_studies','unlock_module'));
    }
}
