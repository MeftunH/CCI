<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerIntro;
use Illuminate\Http\Request;

class FrontPartnerController extends Controller
{
    public function index()
    {

        $intro = PartnerIntro::languages(app()->getLocale())->first();
        $partners = Partner::all()->where('status',1);
        return view('pages.partners', compact('intro','partners'));
    }
}
