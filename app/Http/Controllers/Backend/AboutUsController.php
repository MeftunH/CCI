<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\AboutUsTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Stichoza\GoogleTranslate\GoogleTranslate;


class AboutUsController extends Controller
{

    public function index()
    {
//        $aboutUs = DB::table('about_us')
//            ->join('about_us_translations','aboutUs_id','about_us.id')
//            ->join('languages','language_id','=','languages.id')
//            ->select('about_us.*')->get();
        $aboutUs = AboutUs::languages(app()->getLocale());
//        dd($aboutUs);
//        $aboutUs=AboutUsTranslation::languages();
        return view('admin.aboutUs.intro.intro', compact('aboutUs'));
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
        $aboutUs = AboutUs::where('id', 1)->first();

        $translations = AboutUs::Lang();
        return view('admin.aboutUs.intro.edit', compact('translations', 'aboutUs'));
    }


    public function update(Request $request, $id)
    {
        $about_us = AboutUs::where('id', $id)->first();
        $translations = AboutUs::langSpecificId($about_us->id);

        $about_us_data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $translate_data = array();
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);

        if (isset($image)) {
            $image_uni = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 300)->save('storage/public/images/about_us_intro_images/' . $image_uni);
            $about_us_data['background_image'] = '/storage/public/images/about_us_intro_images/' . $image_uni;
            $about_us->background_image = $about_us_data['background_image'];
            $about_us->save();
//            unlink($old_image);
        } else {
            $about_us_data['background_image'] = $old_image;
        }

        foreach ($request->title as $language => $title) {
            $translation = AboutUsTranslation::where('aboutUs_id', $id)->where('language_id', $language)->first();
            $currLang = Language::where('id', $language)->first();
            $description = $request->description[$language];
            $init_description = strip_tags($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            ////title
            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
            } else if (isset($title) && !isset($description)) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            } else if (!(isset($title) && isset($description))) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
        return Redirect::route('aboutUs.index');
    }


    public function destroy($id)
    {
        //
    }
}
