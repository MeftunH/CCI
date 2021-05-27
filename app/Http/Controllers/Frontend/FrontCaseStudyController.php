<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontCaseStudyController extends Controller
{
    public function index()
    {
        return view('pages.caseStudies');
    }
}
