<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\HomeInnovationModule;
use App\Models\HomeIntro;
use App\Models\HomeUnlockModule;
use App\Models\TechnologyCardImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function index()
    {

        $intro = HomeIntro::languages(app()->getLocale());
        $innovation_module = HomeInnovationModule::languages(app()->getLocale());
        $unlock_module = HomeUnlockModule::languages(app()->getLocale());
        $technology_card_image = TechnologyCardImage::first();
//        $news = News::languages(app()->getLocale());
//        $images = DB::table('images')->get();
        return view('admin.home.intro.index', compact('intro','technology_card_image','innovation_module','unlock_module'));
    }

    public function edit($id)
    {
        $intro = HomeIntro::where('id', $id)->first();

        $translations = HomeIntro::Lang();
        return view('admin.home.intro.edit', compact('translations', 'intro'));
    }
    public function update(Request $request, $id)
    {
        $intro = HomeIntro::where('id', $id)->first();
        $translations = HomeIntro::langSpecificId($intro->id);

        $data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);

        if (isset($image)) {
            $image_uni = uniqid('home_intro', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/home_intro_images/' . $image_uni);
            $intro->background_image = '/storage/public/images/home_intro_images/' . $image_uni;
            $intro->save();
            if (File::exists(public_path($old_image))) {
                File::delete(public_path($old_image));
            }
        } else {
            $data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->homepage_intro_translate_and_save($request, $id);
        return Redirect::route('homepage.index');
    }

    public function innovationModuleEdit($id)
    {
        $innovation = HomeInnovationModule::where('id', $id)->first();

        $translations = HomeInnovationModule::Lang();
        return view('admin.home.innovation_module.edit', compact('translations', 'innovation'));
    }
    public function innovationModuleShow($id)
    {
        $innovation = HomeInnovationModule::where('id', $id)->first();

        $translations = HomeInnovationModule::Lang();
        return view('admin.home.innovation_module.show', compact('translations', 'innovation'));
    }

    public function innovationModuleUpdate(Request $request,$id)
    {
        $validateData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        $sh = new SiteHelper();
        $sh->homepage_innovation_translate_and_save($request, $id);
        return Redirect::route('homepage.index');

    }

    public function unlockModuleEdit($id)
    {
        $unlock = HomeUnlockModule::where('id', $id)->first();

        $translations = HomeUnlockModule::Lang();
        return view('admin.home.unlock_module.edit', compact('translations', 'unlock'));
    }

    public function technologyCardImageEdit($id)
    {

        $tci = TechnologyCardImage::where('id',$id)->first();
        return view('admin.home.technology_card_image.edit', compact('tci'));
    }
    public function technologyCardImageUpdate($id,Request $request)
    {

        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'big_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);
        $tci = TechnologyCardImage::where('id',$id)->first();
        $image = $request->big_image;
        $old_image = $request->old_big_image;
        $old_background_image = $request->old_background_image;
        $background_image = $request->background_image;
        if (isset($image)) {
            $image_uni = uniqid('tci', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/unlock_images/' . $image_uni);
            $tci->big_image = '/storage/public/images/unlock_images/' . $image_uni;

            if (File::exists(public_path($old_image))) {
                File::delete(public_path($old_image));
            }

        }
        else {
            $tci->big_image = $old_image;
        }

        if (isset($background_image)) {
            $image_uni = uniqid('unlock_background', true) . '.' . $background_image->getClientOriginalExtension();
            Image::make($background_image)->save('storage/public/images/unlock_images/' . $image_uni);

            if (Storage::delete($tci->background_image)) {
                File::delete($tci->background_image);
            }
            $tci->background_image = '/storage/public/images/unlock_images/' . $image_uni;
        }
        else {
            $tci->background_image = $old_background_image;
        }

        $tci->save();
        return Redirect::route('homepage.index');
    }
    public function unlockModuleShow($id)
    {
        $unlock = HomeUnlockModule::where('id', $id)->first();

        $translations = HomeUnlockModule::Lang();
        return view('admin.home.unlock_module.show', compact('translations', 'unlock'));
    }

    public function unlockModuleUpdate(Request $request,$id)
    {
        $validateData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
            'footer.1' => ['required'],
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);
        $unlock = HomeUnlockModule::where('id', $id)->first();
        $image = $request->image;
        $old_image = $request->old_image;
        $old_background_image = $request->old__backgroundimage;
        $background_image = $request->background_image;
        if (isset($image)) {
            $image_uni = uniqid('unlock', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/unlock_images/' . $image_uni);
            $unlock->image = '/storage/public/images/unlock_images/' . $image_uni;

            if (File::exists(public_path($old_image))) {
                File::delete(public_path($old_image));
            }

        }
        else {
            $unlock->image = $old_image;
        }

        if (isset($background_image)) {
            $image_uni = uniqid('unlock_background', true) . '.' . $background_image->getClientOriginalExtension();
            Image::make($background_image)->save('storage/public/images/unlock_images/' . $image_uni);

            if (Storage::delete($unlock->background_image)) {
                File::delete($unlock->background_image);
            }
            $unlock->background_image = '/storage/public/images/unlock_images/' . $image_uni;
        }
        else {
            $unlock->background_image = $old_background_image;
        }

        $unlock->save();
        $sh = new SiteHelper();
        $sh->homepage_unlock_translate_and_save($request, $id);
        return Redirect::route('homepage.index');

    }
}
