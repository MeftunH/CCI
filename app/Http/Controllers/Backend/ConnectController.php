<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\ConnectIntro;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class ConnectController extends Controller
{

    public function index()
    {
        $intro = ConnectIntro::languages(app()->getLocale());
        $messages = Contact::paginate(10);
        return view('admin.apply.intro.index', compact('intro','messages'));
    }



    public function show($id)
    {
        $intro = ConnectIntro::where('id', $id)->first();

        $translations = ConnectIntro::Lang();
        return view('admin.connect.intro.show', compact('translations', 'intro'));
    }


    public function edit($id)
    {
        $intro = ConnectIntro::where('id', $id)->first();

        $translations = ConnectIntro::Lang();
        return view('admin.connect.intro.edit', compact('translations', 'intro'));
    }


    public function update(Request $request, $id)
    {
        $intro= ConnectIntro::where('id', $id)->first();
        $translations = ConnectIntro::langSpecificId($intro->id);

        $data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);

        if (isset($image)) {
            $image_uni = uniqid('connect_intro', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/connect_intro_images/' . $image_uni);
            $intro->background_image = '/storage/public/images/connect_intro_images/' . $image_uni;
            $intro->save();
            if (File::exists(public_path($old_image))) {
                File::delete(public_path($old_image));
            }
        } else {
            $data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->connect_intro_translate_and_save($request, $id);
        return Redirect::route('connects.index');
    }

}
