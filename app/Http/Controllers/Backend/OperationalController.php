<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Operational;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class OperationalController extends Controller
{

    public function index()
    {
        $operational = Operational::all()->first();
        return view('admin.aboutUs.operational.index',compact('operational'));
    }


    public function show($id)
    {
        $operational = Operational::where('id', $id)->first();

        $translations = Operational::all()->first();
        return view('admin.aboutUs.operational.show', compact('translations', 'operational'));
    }


    public function edit($id)
    {
        $operational = Operational::where('id', $id)->first();

        $translations = Operational::all()->first();
        return view('admin.aboutUs.operational.edit', compact('translations', 'operational'));
    }
    public function update(Request $request, $id)
    {
        $operational = Operational::where('id', $id)->first();
        $translations = Operational::all()->first();

        $operational_data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $translate_data = array();
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);

        if (isset($image)) {
            $image_uni = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/about_us_intro_images/' . $image_uni);
            $operational_data['background_image'] = '/storage/public/images/about_us_intro_images/' . $image_uni;
            $operational->background_image = $operational_data['background_image'];
            $operational->save();
//            unlink($old_image);
        } else {
            $operational_data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->operational_translate_and_save($request, $id);
        return Redirect::route('aboutUs.operational.index');
    }
}
