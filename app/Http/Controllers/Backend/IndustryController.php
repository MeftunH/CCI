<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Industry;
use App\Models\IndustryClient;
use App\Models\IndustryClientItem;
use App\Models\IndustryExperience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class IndustryController extends Controller
{

    public function index()
    {
        $industry = Industry::languages(app()->getLocale());
        return view('admin.industries.intro.index', compact('industry'));
    }

    public function industryClientItemCreate()
    {
        return view('admin.industries.items.create');
    }

    public function industryClientSave(Request $request)
    {
        $ic_item = new IndustryClientItem();
        $ici = $ic_item->create();
        $ici_translation = new IndustryClientItem();
        $ici_translation->title = $request->title;
        $sh = new SiteHelper();
        $sh->industry_client_item_translate_and_save($request, $ici->id);
        return Redirect::route('aboutUs.industry.client.index');
    }

    public function industryClientItemEdit($id)
    {
        $industry_client_item = IndustryClientItem::where('id', $id)->first();

        $translations = IndustryClientItem::Lang()->where('item_id', $id);
        return view('admin.industries.items.edit', compact('translations', 'industry_client_item'));
    }

    public function industryClientItemUpdate(Request $request, $id)
    {
        $industry_client_item = IndustryClientItem::where('id', $id)->first();
        $translations = IndustryClientItem::langSpecificId($industry_client_item->id);

        $sh = new SiteHelper();
        $sh->industry_client_item_translate_and_update($request, $industry_client_item->id);
        return Redirect::route('aboutUs.industry.client.index');
    }

    public function industryClientItemShow($id)
    {
        $industry_client_item = IndustryClientItem::where('id', $id)->first();

        $translations = IndustryClientItem::Lang();

        return view('admin.industries.items.show', compact('industry_client_item', 'translations'));
    }

    public function industryClientItemDestroy($id)
    {
        IndustryClientItem::find($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }

    public function show($id)
    {
        $industry = Industry::where('id', $id)->first();
        $translations = Industry::Lang();

        return view('admin.industries.intro.show', compact('translations', 'industry'));
    }


    public function edit($id)
    {
        $industry = Industry::where('id', $id)->first();

        $translations = Industry::Lang();
        return view('admin.industries.intro.edit', compact('translations', 'industry'));
    }

    public function industryClient()
    {
        $industry_client = IndustryClient::languages(app()->getLocale());
        $industry_client_items = IndustryClientItem::languages(app()->getLocale());
        $experiences = IndustryExperience::languages(app()->getLocale());
        $experience_items = IndustryExperience::languages(app()->getLocale());
        $active_count = $experience_items->where('status', 1)->count();
        return view('admin.industries.client.index', compact('active_count', 'experience_items', 'experiences', 'industry_client', 'industry_client_items'));
    }

    public function industryClientEdit($id)
    {
        $industry_client = IndustryClient::where('id', $id)->first();

        $translations = IndustryClient::Lang();
        return view('admin.industries.client.edit', compact('translations', 'industry_client'));
    }

    public function experienceEdit($id)
    {
        $experience = IndustryExperience::whereId($id)->first();
        $translations = IndustryExperience::LangSpecificId($experience->id);
        return view('admin.industries.experience.edit', compact('translations', 'experience'));
    }
    public function experienceShow($id)
    {
        $experience = IndustryExperience::whereId($id)->first();
        $translations = IndustryExperience::LangSpecificId($experience->id);
        return view('admin.industries.experience.show', compact('translations', 'experience'));
    }
    public function update(Request $request, $id)
    {
        $industry = Industry::where('id', $id)->first();
        $translations = Industry::langSpecificId($industry->id);

        $industry_data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $translate_data = array();
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);

        if (isset($image)) {
            $image_uni = uniqid('industry', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/industry_intro_images/' . $image_uni);
            $industry->background_image = '/storage/public/images/industry_intro_images/' . $image_uni;
            $industry->save();
            if ($request->hasFile($old_image)) {
                unlink($old_image);
            }
        } else {
            $industry_data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->industry_translate_and_save($request, $id);
        return Redirect::route('industry.index');
    }

    public function experienceUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        $experience = IndustryExperience::where('id', $id)->first();

        $image = $request->image;
        $old_image = $request->old_image;
        $experience->status = $request->get('status');
        if ($request->get('status') == null) {
            $experience->status = 1;
        }

        if (isset($image)) {
            $image_uni = uniqid('experience', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/experience_images/' . $image_uni);
            $experience->image = '/storage/public/images/experience_images/' . $image_uni;
            if ($request->hasFile($old_image)) {
                File::delete('storage/public/images/experience_images/' . $old_image);
            }


        } else {
            $experience->image = $old_image;
        }
        $experience->save();
        $sh = new SiteHelper();
        $sh->experience_translate_and_update($request, $id);
        return Redirect::route('aboutUs.industry.client.index');
    }

    public function industryClientUpdate(Request $request, $id)
    {
        $industry_client = IndustryClient::where('id', $id)->first();
        $translations = IndustryClient::langSpecificId($industry_client->id);

        $industry_client_data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $translate_data = array();
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);

        if (isset($image)) {
            $image_uni = uniqid('industryClient', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/industry_client_images/' . $image_uni);
            $industry_client->background_image = '/storage/public/images/industry_client_images/' . $image_uni;
            if ($request->hasFile($old_image)) {
                File::delete('storage/public/images/industry_client_images/' . $old_image);
            }
            $industry_client->save();

        } else {
            $industry_client_data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->industry_client_translate_and_save($request, $id);
        return Redirect::route('aboutUs.industry.client.index');

    }

    public function industryClientShow($id)
    {
        $industry_client = IndustryClient::where('id', $id)->first();

        $translations = IndustryClient::Lang();
        return view('admin.industries.client.show', compact('translations', 'industry_client'));
    }


    public function experienceCreate()
    {
        return view('admin.industries.experience.create');
    }

    public function experienceSave(Request $request)
    {
        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192|required',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required', 'min:1'],
        ]);

        $active_count = IndustryExperience::all()->where('status', 1)->count();


        if ($active_count < 3) {
            $experience = new IndustryExperience();
            $image = $request->image;
            $experience->status = $request->get('status');
            if ($request->get('status') == null) {
                $experience->status = 1;
            }

            if (isset($image)) {
                $image_uni = uniqid('academy_card', true) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('storage/public/images/experience_images/' . $image_uni);
                $experience->image = '/storage/public/images/experience_images/' . $image_uni;
            }

            $created_experience = $experience->create(['image' => $experience->image, 'status' => $experience->status]);
            if ($created_experience != null) {
                $sh = new SiteHelper();
                $sh->industry_experience_translate_and_save($request, $created_experience->id);
            }
        }
        return Redirect::route('aboutUs.industry.client.index');
    }

    public function experienceDestroy($id)
    {
        IndustryExperience::findOrFail($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }

}
