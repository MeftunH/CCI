<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use App\Models\Client;
use App\Models\Study;
use Illuminate\Http\Request;

class FrontCaseStudyController extends Controller
{
    public function index()
    {
        $case_study = CaseStudy::languages(app()->getLocale())->first();
        $slider_clients = Client::all()->where('is_slide_content', 1);
        $clients =  Client::all();
        $last_studies = Study::languages(app()->getLocale())->where('studies.status',1)->orderBy('id','desc')->take(3)->get();
        return view('pages.caseStudies.caseStudies',compact('last_studies','clients','case_study','slider_clients'));
    }
    public function all_case_studies()
    {
        $studies = Study::languages(app()->getLocale())->where('studies.status',1)->orderBy('id','desc')->get();

        return view('pages.caseStudies.all_case_studies',compact('studies'));
    }
    public function read_more($id)
    {
        $study = Study::languages(app()->getLocale())->where('studies.status',1)->where('studies.id',$id)->first();

        return view('pages.caseStudies.read_more',compact('study'));
    }
}
