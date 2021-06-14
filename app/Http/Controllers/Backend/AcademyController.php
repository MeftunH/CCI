<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Academy;
use App\Models\AcademyCard;
use App\Models\AcademyCardTranslation;
use App\Models\AcademyCareer;
use App\Models\AcademyCareerItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class AcademyController extends Controller
{

    public function index()
    {
        $academy = Academy::languages(app()->getLocale());

        return view('admin.academy.intro.index', compact('academy'));
    }

    public function show($id)
    {
        $academy = Academy::where('id', $id)->first();

        $translations = Academy::Lang();
        return view('admin.academy.intro.show', compact('translations', 'academy'));
    }

    public function edit($id)
    {
        $academy = Academy::where('id', $id)->first();

        $translations = Academy::Lang();
        return view('admin.academy.intro.edit', compact('translations', 'academy'));
    }

    public function update(Request $request, $id)
    {
        $academy = Academy::where('id', $id)->first();
        $translations = Academy::langSpecificId($academy->id);

        $academy_data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $translate_data = array();
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);

        if (isset($image)) {
            $image_uni = uniqid('', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/academy_images/' . $image_uni);
            $academy_data['background_image'] = '/storage/public/images/academy_images/' . $image_uni;
            $academy->background_image = $academy_data['background_image'];
            $academy->save();
            if ($request->has('old_image')) {
                File::delete('storage/public/images/academy_images/'.$old_image);
            }
        } else {
            $academy_data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->academy_translate_and_save($request, $id);
        return Redirect::route('academy.index');
    }

    public function academyCareer()
    {
        $academy_career = AcademyCareer::languages(app()->getLocale());
        $academy_cards = AcademyCard::languages(app()->getLocale());
        $academy_career_items = AcademyCareerItem::languages(app()->getLocale())->paginate(5);
        $active_count = $academy_cards->where('status', 1)->count();
        return view('admin.academy.career.index', compact('active_count', 'academy_cards', 'academy_career', 'academy_career_items'));
    }

    public function academyCareerEdit($id)
    {
        $academy_career = AcademyCareer::where('id', $id)->first();
        $translations = AcademyCareer::Lang();
        return view('admin.academy.career.edit', compact('translations', 'academy_career'));
    }

    public function academyCareerUpdate(Request $request, $id)
    {
        $academy_career = AcademyCareer::where('id', $id)->first();
        $translations = AcademyCareer::langSpecificId($academy_career->id);

        $academy_career_data = array();
        $translate_data = array();
        $academy_career->save();
        $sh = new SiteHelper();
        $sh->academy_career_translate_and_save($request, $id);
        return Redirect::route('aboutUs.academyCareer.index');
    }

    public function academyCareerShow($id)
    {
        $academy_career = AcademyCareer::where('id', $id)->first();
        $translations = AcademyCareer::Lang();
        return view('admin.academy.career.show', compact('translations', 'academy_career'));
    }

    public function academyCareerItemCreate()
    {
        return view('admin.academy.career.items.create');

    }

    public function academyCareerItemSave(Request $request)
    {
        $academy_career_item = new AcademyCareerItem();
        $ac = $academy_career_item->create();
        $academy_career_item_translation = new AcademyCareerItem();
        $academy_career_item_translation->title = $request->title;
        $sh = new SiteHelper();
        $sh->academy_career_item_translate_and_save($request, $ac->id);
        return Redirect::route('aboutUs.academyCareer.index');

    }

    public function academyCareerItemEdit($id)
    {

        $academy_career_item = AcademyCareerItem::where('id', $id)->first();

        $translations = AcademyCareerItem::Lang()->where('item_id', $id);
        return view('admin.academy.career.items.edit', compact('translations', 'academy_career_item'));
    }

    public function academyCareerItemUpdate(Request $request, $id)
    {

        $academy_career_item = AcademyCareerItem::where('id', $id)->first();
        $translations = AcademyCareerItem::langSpecificId($academy_career_item->id);

        $sh = new SiteHelper();
        $sh->academy_career_item_translate_and_update($request, $academy_career_item->id);
        return Redirect::route('aboutUs.academyCareer.index');
    }

    public function academyCareerItemShow($id)
    {
        $academy_career_item = AcademyCareerItem::where('id', $id)->first();
        $translations = AcademyCareerItem::Lang()->where('item_id', $id);

        return view('admin.academy.career.items.show', compact('academy_career_item', 'translations'));
    }

    public function academyCareerItemDestroy($id)
    {
        AcademyCareerItem::find($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }

    public function academyCardCreate()
    {
        return view('admin.academy.career.cards.create');
    }

    public function academyCardSave(Request $request)
    {
        $active_count = AcademyCard::all()->where('status', 1)->count();
        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192|required',
        ]);



        if ($active_count < 4) {
            $card = new AcademyCard();
            $image = $request->image;
            $card->status = $request->get('status');
            if ($request->get('status') == null) {
                $card->status = 1;
            }

            if (isset($image)) {
                $image_uni = uniqid('academy_card', true) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('storage/public/images/academy_card_images/' . $image_uni);
                $card->image = '/storage/public/images/academy_card_images/' . $image_uni;
            }
//        dd($request->all());

            $created_card = $card->create(['image' => $card->image, 'status' => $card->status]);
            if ($created_card != null) {
                $sh = new SiteHelper();
                $sh->academy_card_translate_and_save($request, $created_card->id);
            }
        }
        return Redirect::route('aboutUs.academyCareer.index');

    }

    public function academyCardEdit($id)
    {
        $academy_card = AcademyCard::select('*')->where('id', $id)->first();
        $translations = AcademyCardTranslation::select('*')->where('academy_card_id', $id)->get();
        return view('admin.academy.career.cards.edit', compact('academy_card', 'translations'));
    }

    public function academyCardUpdate(Request $request, $id)
    {
        $academy_card = AcademyCard::where('id', $id)->first();
        $translations = AcademyCard::langSpecificId($id);

        $academy_card_data = array();
        $image = $request->image;
        $old_image = $request->old_image;
        $translate_data = array();
        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);
        $status = $request->status;
        if ($status == null)
        {
            $status = 1;
        }
        if (isset($image)) {
            $image_uni = uniqid('cs', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/academy_card_images/' . $image_uni);
            $academy_card->image = '/storage/public/images/academy_card_images/' . $image_uni;

            if ($request->hasFile($old_image))
                File::delete('storage/public/images/academy_card_images/'.$old_image);
        } else {
            $academy_card_data['image'] = $old_image;
        }
        $academy_card->status = $status;
        $academy_card->save();
        $sh = new SiteHelper();
        $sh->academy_card_translate_and_update($request, $id);
        return Redirect::route('aboutUs.academyCareer.index');
    }

    public function academyCardShow($id)
    {
        $academy_card = AcademyCard::select('*')->where('id', $id)->first();
        $translations = AcademyCardTranslation::select('*')->where('academy_card_id', $id)->get();
        return view('admin.academy.career.cards.show', compact('academy_card', 'translations'));
    }

    public function academyCardDestroy($id): \Illuminate\Http\RedirectResponse
    {
        AcademyCard::find($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }
}
