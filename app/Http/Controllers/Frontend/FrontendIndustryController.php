<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\IndustryClient;
use App\Models\IndustryClientItem;
use App\Models\IndustryExperience;
use Illuminate\Http\Request;

class FrontendIndustryController extends Controller
{

    public function index()
    {

        $industry = Industry::first();
        $translation = Industry::languages(app()->getLocale())->first();
        $industry_client = IndustryClient::first();
        $industry_client_translation = IndustryClient::languages(app()->getLocale())->first();
        $industry_client_items = IndustryClientItem::languages(app()->getLocale());
        $experience_items = IndustryExperience::getOnlyActiveItems(app()->getLocale());
        return view('pages.industries.industries',compact('experience_items','industry','industry_client_items','translation','industry_client','industry_client_translation'));
    }

    public function read_more($id)
    {
        $experience_item = IndustryExperience::where('id',$id)->first();
        $translations = IndustryExperience::languages(app()->getLocale())->where('experience_id',$id)->where('status',1)->first();
        return view('pages.industries.read_more',compact('experience_item','translations'));
    }
}
