<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\AcademyCard;
use App\Models\AcademyCareerItem;
use App\Models\Career;
use App\Models\CareerConsulting;
use App\Models\CareerConsultingCard;
use App\Models\CareerConsultingItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class CareerController extends Controller
{

    public function index()
    {
        $career = Career::languages(app()->getLocale());

        return view('admin.career.intro.index', compact('career'));
    }

    public function show($id)
    {
        $career = Career::where('id', $id)->first();

        $translations = Career::Lang();
        return view('admin.career.intro.show', compact('translations', 'career'));
    }


    public function edit($id)
    {
        $career = Career::where('id', $id)->first();
        $translations = Career::Lang();
        return view('admin.career.intro.edit', compact('translations', 'career'));
    }

    public function update(Request $request, $id)
    {
        $career = Career::where('id', $id)->first();
        $translations = Career::langSpecificId($career->id);

        $academy_data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $translate_data = array();
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);

        if (isset($image)) {
            $image_uni = uniqid('', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/career_images/' . $image_uni);
            $academy_data['background_image'] = '/storage/public/images/career_images/' . $image_uni;
            $career->background_image = $academy_data['background_image'];
            $career->save();
            if ($request->has('old_image')) {
                File::delete('storage/public/images/academy_images/'.$old_image);
            }
        } else {
            $academy_data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->career_translate_and_save($request, $id);
        return Redirect::route('career.index');
    }

    public function careerConsulting()
    {
        $career_consulting = CareerConsulting::languages(app()->getLocale());
        $cc_cards = CareerConsultingCard::languages(app()->getLocale());
        $career_consulting_items = CareerConsultingItem::languages(app()->getLocale())->paginate(5);
        $active_count = $cc_cards->where('status', 1)->count();
        return view('admin.career.career_consulting.index', compact('active_count', 'cc_cards', 'career_consulting', 'career_consulting_items'));
    }

    public function careerConsultingEdit($id)
    {
        $career_consulting = CareerConsulting::where('id', $id)->first();
        $translations = CareerConsulting::Lang();
        return view('admin.career.career_consulting.edit', compact('translations', 'career_consulting'));
    }

    public function careerConsultingUpdate(Request $request,$id)
    {
        $career_consulting = CareerConsulting::where('id', $id)->first();
        $translations = CareerConsulting::langSpecificId($career_consulting->id);

        $career_consulting->save();
        $sh = new SiteHelper();
        $sh->career_consulting_translate_and_save($request, $id);
        return Redirect::route('careerConsulting.index');
    }

    public function careerConsultingShow($id)
    {
        $career_consulting = CareerConsulting::where('id', $id)->first();
        $translations = CareerConsulting::Lang();
        return view('admin.career.career_consulting.show', compact('translations', 'career_consulting'));
    }

    public function careerConsultingItemCreate()
    {
        return view('admin.career.career_consulting.items.create');

    }

    public function careerConsultingItemSave(Request $request)
    {
        $career_consulting_item = new CareerConsultingItem();
        $cc = $career_consulting_item->create();
        $career_consulting_item_translation = new CareerConsultingItem();
        $career_consulting_item_translation->title = $request->title;
        $sh = new SiteHelper();
        $sh->career_consulting_item_translate_and_save($request, $cc->id);
        return Redirect::route('careerConsulting.index');

    }

    public function careerConsultingItemEdit($id)
    {
        $career_consulting_item = CareerConsultingItem::where('id', $id)->first();

        $translations = CareerConsultingItem::Lang()->where('item_id', $id);
        return view('admin.career.career_consulting.items.edit', compact('translations', 'career_consulting_item'));
    }

    public function careerConsultingItemUpdate(Request $request,$id)
    {
        $career_consulting_item = CareerConsultingItem::where('id', $id)->first();
        $translations = CareerConsultingItem::langSpecificId($career_consulting_item->id);

        $sh = new SiteHelper();
        $sh->career_consulting_item_translate_and_update($request, $career_consulting_item->id);
        return Redirect::route('careerConsulting.index');
    }

    public function careerConsultingItemShow($id)
    {
        $career_consulting_item = CareerConsultingItem::where('id', $id)->first();
        $translations = CareerConsultingItem::Lang()->where('item_id', $id);

        return view('admin.career.career_consulting.items.show', compact('career_consulting_item', 'translations'));
    }

    public function careerConsultingItemDestroy($id)
    {
        CareerConsultingItem::find($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }

    public function careerConsultingCardCreate()
    {
        return view('admin.career.career_consulting.cards.create');
    }
    public function careerConsultingCardSave(Request $request)
    {

        $active_count = CareerConsultingCard::all()->where('status', 1)->count();
        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192|required',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);


        if ($active_count < 4) {
            $card = new CareerConsultingCard();
            $image = $request->image;
            $card->status = $request->get('status');
            if ($request->get('status') == null) {
                $card->status = 1;
            }

            if (isset($image)) {
                $image_uni = uniqid('cc_card', true) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('storage/public/images/career_card_images/' . $image_uni);
                $card->image = '/storage/public/images/career_card_images/' . $image_uni;
            }

            $created_card = $card->create(['image' => $card->image, 'status' => $card->status]);
            if ($created_card != null) {
                $sh = new SiteHelper();
                $sh->career_consulting_card_translate_and_save($request, $created_card->id);
            }
        }
        return Redirect::route('careerConsulting.index');

    }
}
