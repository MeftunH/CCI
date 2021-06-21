<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerIntro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class PartnerController extends Controller
{

    public function index()
    {
        $intro = PartnerIntro::languages(app()->getLocale());
        $partners = Partner::paginate(10);
        return view('admin.partners.intro.index', compact('intro','partners'));
    }


    public function show($id)
    {
        $intro = PartnerIntro::where('id', $id)->first();

        $translations = PartnerIntro::Lang();
        return view('admin.partners.intro.show', compact('translations', 'intro'));
    }


    public function edit($id)
    {
        $intro = PartnerIntro::where('id', $id)->first();

        $translations = PartnerIntro::Lang();
        return view('admin.partners.intro.edit', compact('translations', 'intro'));
    }


    public function update(Request $request, $id)
    {
        $intro= PartnerIntro::where('id', $id)->first();
        $translations = PartnerIntro::langSpecificId($intro->id);

        $data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);

        if (isset($image)) {
            $image_uni = uniqid('partner_intro', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/partner_intro_images/' . $image_uni);
            $intro->background_image = '/storage/public/images/partner_intro_images/' . $image_uni;
            $intro->save();
            if (File::exists(public_path($old_image))) {
                File::delete(public_path($old_image));
            }
        } else {
            $data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->partner_intro_translate_and_save($request, $id);
        return Redirect::route('partner.index');
    }


    public function partnerItemCreate()
    {
        return view('admin.partners.partner.create');
    }

    public function partnerItemSave(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192|required',
            'title' => 'required',
        ]);
//dd($request->all());

        $partner = new Partner();
        $image = $request->image;
        if (isset($image)) {
            $image_uni = uniqid('partner', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/partner_images/' . $image_uni);
            $partner->image = '/storage/public/images/partner_images/' . $image_uni;
        }

        $partner->title = $request->title;
        $partner->status = $request->status;

        if ($request->get('status') == null) {
            $partner->status = 1;
        }
        $partner->save();
        return Redirect::route('partner.index');

    }

    public function partnerItemEdit($id)
    {
        $partner = Partner::whereId($id)->first();
        return view('admin.partners.partner.edit',compact('partner'));
    }
    public function partnerItemShow($id)
    {
        $partner = Partner::whereId($id)->first();
        return view('admin.partners.partner.show',compact('partner'));
    }
    public function partnerItemUpdate(Request $request,$id)
    {
        $partner = new Partner();
        $partner->exists = true;
        $partner->id = $id;

        $image = $request->image;
        $title = $request->title;
        $old_image = $request->old_image;

        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title' => 'required',
        ]);

        if (isset($image)) {
            $image_uni = uniqid('', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/partner_images/' . $image_uni);
            $partner->image = '/storage/public/images/partner_images/' . $image_uni;
            if ($request->hasFile($old_image))
                File::delete('storage/public/images/partner_images/'.$old_image);

        } else {
            $partner->image = $old_image;
        }

        if ($request->get('status') == null) {
            $status = 0;
        } else {
            $status = request('status');
        }
        $partner->status = $status;
        $partner->title = $title;
        $partner->save();

        return Redirect::route('partner.index');
    }

    public function partnerItemDestroy($id)
    {
        $partner = Partner::findOrFail($id);
        if (File::exists(public_path($partner->image))) {
            File::delete(public_path($partner->image));
        }
        $partner->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }
}
