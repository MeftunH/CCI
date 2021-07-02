<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\UploadResume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use function Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{

    public function index()
    {
        $resume_intro = UploadResume::languages(app()->getLocale());
        $resumes = Resume::all();
        return view('admin.career.resume.index', compact('resume_intro','resumes'));
    }


    public function download($id): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
       $resume = Resume::where('id',$id)->firstOrFail();
       $pathToFile = 'storage/'.($resume->resume);
       return response()->download($pathToFile);
    }
    public function show($id)
    {
        $resume_intro = UploadResume::where('id', $id)->first();

        $translations = UploadResume::Lang();
        return view('admin.career.resume.show', compact('translations', 'resume_intro'));
    }

    public function edit($id)
    {
        $resume_intro = UploadResume::where('id', $id)->first();

        $translations = UploadResume::Lang();
        return view('admin.career.resume.edit', compact('translations', 'resume_intro'));
    }

    public function update(Request $request, $id)
    {
        $resumeUp= UploadResume::where('id', $id)->first();
        $translations = UploadResume::langSpecificId($resumeUp->id);

        $resume_data = array();
        $image = $request->image;
        $old_image = $request->old_image;
        $translate_data = array();
        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
            'footer.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);

        if (isset($image)) {
            $image_uni = uniqid('resume', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/resume_intro_images/' . $image_uni);
            $resume_data['image'] = '/storage/public/images/resume_intro_images/' . $image_uni;
            $resumeUp->image = $resume_data['image'];
            $resumeUp->save();
            File::delete('storage/public/images/resume_intro_images/'.$old_image);
        } else {
            $resume_data['image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->resume_intro_translate_and_save($request, $id);
        return Redirect::route('resumeUp.index');
    }

}
