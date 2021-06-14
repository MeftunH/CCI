<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\AcademyCard;
use App\Models\AcademyCareer;
use App\Models\AcademyCareerItem;
use Illuminate\Http\Request;

class FrontAcademyController extends Controller
{

    public function index()
    {
        $academy = Academy::first();
        $translation = Academy::languages(app()->getLocale())->first();
        $academy_career = AcademyCareer::languages(app()->getLocale())->first();
        $academy_career_items = AcademyCareerItem::languages(app()->getLocale())->get();
        $academy_cards = AcademyCard::languages(app()->getLocale())->where('status',1);
        return view('pages.academy.academy',compact('academy_cards','academy_career_items','academy_career','academy','translation'));
    }

    public function read_more($id)
    {
        $academy_card = AcademyCard::where('id',$id)->first();
        $translations = AcademyCard::languages(app()->getLocale())->where('academy_card_id',$id)->where('status',1)->first();

        return view('pages.academy.read_more',compact('academy_card','translations'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
