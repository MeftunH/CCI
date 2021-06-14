<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\CareerConsulting;
use App\Models\CareerConsultingItem;
use Illuminate\Http\Request;

class FrontCareerController extends Controller
{

    public function index()
    {
        $career = Career::languages(app()->getLocale())->first();
        $career_consulting = CareerConsulting::languages(app()->getLocale())->first();
        $career_consulting_items = CareerConsultingItem::languages(app()->getLocale())->get();
        return view('pages.careers.careers',compact('career','career_consulting','career_consulting_items'));
    }
}
