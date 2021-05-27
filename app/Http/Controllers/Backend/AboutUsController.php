<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\AboutUsTranslation;
use App\Models\Language;
use App\Models\LongTerm;
use App\Models\LongTermItem;
use App\Models\TimeLine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Helpers\SiteHelper;

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

    public function longTermItemCreate()
    {
        return view('admin.aboutUs.longTerm.items.create');
    }

    public function longTermItemSave(Request $request)
    {
        $long_term_item = new LongTermItem();
        $lti = $long_term_item->create();
        $long_term_item_translation = new LongTermItem();
        $long_term_item_translation->title = $request->title;
        $sh = new SiteHelper();
        $sh->long_term_item_translate_and_save($request, $lti->id);
        return Redirect::route('aboutUs.long_term.index');
    }

    public function longTermItemEdit($id)
    {

        $long_term = LongTermItem::where('id', $id)->first();

        $translations = LongTermItem::Lang()->where('item_id', $id);
        return view('admin.aboutUs.longTerm.items.edit', compact('translations', 'long_term'));
    }

    public function longTermItemUpdate(Request $request, $id)
    {

        $long_term_item = LongTermItem::where('id', $id)->first();
        $translations = LongTermItem::langSpecificId($long_term_item->id);

        $sh = new SiteHelper();
        $sh->long_term_item_translate_and_update($request, $long_term_item->id);
        return Redirect::route('aboutUs.long_term.index');
    }

    public function longTermItemShow($id)
    {
        $long_term = LongTermItem::where('id', $id)->first();
        $translations = LongTermItem::Lang();

        return view('admin.aboutUs.longTerm.items.show', compact('long_term', 'translations'));
    }

    public function create()
    {
        //
    }

    public function longTermItemDestroy($id)
    {
        LongTermItem::find($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }

    public function show($id)
    {
        $aboutUs = AboutUs::where('id', $id)->first();

        $translations = AboutUs::Lang();
        return view('admin.aboutUs.intro.show', compact('translations', 'aboutUs'));
    }


    public function edit($id)
    {
        $aboutUs = AboutUs::where('id', $id)->first();

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
            Image::make($image)->save('storage/public/images/about_us_intro_images/' . $image_uni);
            $about_us_data['background_image'] = '/storage/public/images/about_us_intro_images/' . $image_uni;
            $about_us->background_image = $about_us_data['background_image'];
            $about_us->save();
//            unlink($old_image);
        } else {
            $about_us_data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->translate_and_save($request, $id);
        return Redirect::route('aboutUs.index');
    }


    public function destroy($id)
    {
        //
    }

    public function longTerm()
    {
        $long_term = LongTerm::languages(app()->getLocale());
        $long_term_items = LongTermItem::languages(app()->getLocale());
        $time_line = TimeLine::languages(app()->getLocale());
        return view('admin.aboutUs.longTerm.index', compact('long_term', 'long_term_items', 'time_line'));
    }

    public function longTermShow()
    {
        $long_term = LongTerm::languages(app()->getLocale());
        $translations = LongTerm::Lang();
        return view('admin.aboutUs.longTerm.show', compact('long_term', 'translations'));
    }


    public function longTermEdit($id)
    {
        $long_term = LongTerm::where('id', $id)->first();

        $translations = LongTerm::Lang();
        return view('admin.aboutUs.longTerm.edit', compact('translations', 'long_term'));
    }

    public function longTermUpdate(Request $request, $id)
    {
        $long_term = LongTerm::where('id', $id)->first();
        $translations = LongTerm::langSpecificId($long_term->id);

        $long_term_data = array();
        $translate_data = array();
        $long_term->save();
        $sh = new SiteHelper();
        $sh->long_term_translate_and_save($request, $id);
        return Redirect::route('aboutUs.long_term.index');
    }

    public function timeline()
    {
        $time_line = TimeLine::languages(app()->getLocale());

        return view('admin.aboutUs.longTerm.index', compact('time_line'));

    }

    public function timeLineCreate()
    {
        $time_line = TimeLine::languages(app()->getLocale());

        return view('admin.aboutUs.longTerm.timeLine.create', compact('time_line'));
    }

    public function timeLineSave(Request $request)
    {
        $time_line = new TimeLine();
        $validatedData = $request->validate([
            'date' => ['required'],
        ]);
        $tl = $time_line->create(['date' => $request->date]);

        $sh = new SiteHelper();
        $sh->time_line_translate_and_save($request, $tl->id);
        return Redirect::route('aboutUs.long_term.index');
    }

    public function timeLineEdit($id)
    {
        $time_line = TimeLine::where('id', $id)->first();

        $translations = TimeLine::Lang($time_line->id);
        return view('admin.aboutUs.longTerm.timeLine.edit', compact('translations', 'time_line'));
    }

    public function timeLineUpdate(Request $request, $id)
    {
        $time_line = TimeLine::where('id', $id)->first();
        $translations = TimeLine::langSpecificId($time_line->id);
        $time_line->date = $request->date;
        $time_line->save();
        $sh = new SiteHelper();
        $sh->time_line_translate_and_update($request, $id);
        return Redirect::route('aboutUs.long_term.index');
    }
    public function timeLineShow($id)
    {
        $time_line = TimeLine::where('id', $id)->first();
        $translations = TimeLine::Lang($id);
        return view('admin.aboutUs.longTerm.timeLine.show', compact('time_line','translations'));
    }
    public function timeLineDestroy($id)
    {
        TimeLine::find($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }

}
