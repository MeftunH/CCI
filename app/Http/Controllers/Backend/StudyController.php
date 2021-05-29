<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\Study;
use App\Models\StudyTranslation;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class StudyController extends Controller
{
    public function index()
    {
        $studies = Study::select('*')->languages(app()->getLocale())->paginate(10);
        return view('admin.caseStudies.studies.index', compact('studies'));
    }


    public function create()
    {
        return view('admin.caseStudies.studies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192|required',
        ]);
        $image = $request->image;

        $study = new Study();
        if (isset($image)) {
            $image_uni = uniqid('study', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/study_images/' . $image_uni);
            $study->background_image = '/storage/public/images/study_images/' . $image_uni;
            $study->status = $request->get('status');
            if ($request->get('status') == null) {
                $study->status = 1;
            }
            $st = $study->create(['image' => $study->background_image, 'status' => $study->status]);
            $sh = new SiteHelper();
            $sh->study_translate_and_save($request, $st->id);
        }
        return Redirect::route('studies.index');
    }


    public function show($id)
    {
        $study = Study::where('id', $id)->first();
        $translations = Study::Lang();
        return view('admin.caseStudies.studies.show', compact('study', 'translations'));
    }

    public function edit($id)
    {

        $study = Study::where('id', $id)->first();
        $translations = Study::Lang($study->id);
        return view('admin.caseStudies.studies.edit', compact('study', 'translations'));
    }


    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {

        $study = Study::where('id', $id)->first();
        $translations = Study::langSpecificId($study->id);

        $study_data = array();
        $image = $request->image;
        $old_image = $request->old_image;
        $translate_data = array();
        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);

        if ($request->has('image')) {
            $image_uni = uniqid('study', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/study_images/' . $image_uni);
            $study->image = '/storage/public/images/study_images/' . $image_uni;
            if ($request->hasFile($old_image))
            unlink($old_image);
        } else {
            $study_data['image'] = $old_image;
        }
        if ($request->get('status') == null) {
            $status = 1;
        } else {
            $status = request('status');
        }
        $study->status = $status;
        $study->save();
        $sh = new SiteHelper();
        $sh->study_translate_and_update($request, $id);
        return Redirect::route('studies.index');
    }



    public function destroy($id)
    {

        Study::find($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }
}
