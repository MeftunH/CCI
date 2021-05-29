<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class CaseStudyController extends Controller
{
    public function index()
    {
        $case_study = CaseStudy::languages(app()->getLocale());
        $clients = Client::all();
        return view('admin.caseStudies.intro.index',compact('case_study','clients'));
    }

    public function edit($id)
    {
        $case_study = CaseStudy::select('*')->where('id',$id)->first();
        $translations = CaseStudy::Lang();
        return view('admin.caseStudies.intro.edit',compact('case_study','translations'));
    }

    public function update(Request $request,$id)
    {
        $case_study = CaseStudy::where('id', $id)->first();
        $translations = CaseStudy::langSpecificId($case_study->id);

        $case_study_data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $translate_data = array();
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);

        if (isset($image)) {
            $image_uni = uniqid('cs', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/case_study_images/' . $image_uni);
            $case_study_data['background_image'] = '/storage/public/images/case_study_images/' . $image_uni;
            $case_study->background_image = $case_study_data['background_image'];
            $case_study->save();
            unlink($old_image);
        } else {
            $case_study_data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->case_study_translate_and_save($request, $id);
        return Redirect::route('caseStudies.index');
    }

    public function show($id)
    {
        $case_study = CaseStudy::select('*')->where('id',$id)->first();
        $translations = CaseStudy::Lang();
        return view('admin.caseStudies.intro.show',compact('case_study','translations'));
    }
}
