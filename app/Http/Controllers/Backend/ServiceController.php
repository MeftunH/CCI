<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\IndustryExperience;
use App\Models\InnovationService;
use App\Models\InnovationServiceItem;
use App\Models\Service;
use App\Models\ServiceCard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{

    public function index()
    {
        $service = Service::languages(app()->getLocale());
        return view('admin.services.intro.intro', compact('service'));
    }


    public function show($id)
    {
        $service = Service::where('id', $id)->first();

        $translations = Service::Lang();
        return view('admin.services.intro.show', compact('translations', 'service'));
    }

    public function edit($id)
    {
        $service = Service::where('id', $id)->first();

        $translations = Service::Lang();
        return view('admin.services.intro.edit', compact('translations', 'service'));
    }


    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $service = Service::where('id', $id)->first();
        $translations = Service::langSpecificId($service->id);

        $image = $request->background_image;
        $old_image = $request->old_image;
        $validateData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);

        if (isset($image)) {
            $image_uni = uniqid('service', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/service_intro_images/' . $image_uni);
            $about_us_data['background_image'] = '/storage/public/images/service_intro_images/' . $image_uni;
            $service->background_image = $about_us_data['background_image'];
            File::delete('storage/public/images/service_intro_images/'.$old_image);
            $service->save();
        } else {
            $service->background_image = $old_image;
        }

        $sh = new SiteHelper();
        $sh->service_translate_and_save($request, $id);
        return Redirect::route('service.index');
    }

    public function innovation()
    {
        $innovation = InnovationService::languages(app()->getLocale());
        $innovation_items = InnovationServiceItem::languages(app()->getLocale());
        $service_cards = ServiceCard::languages(app()->getLocale());
        $active_count = $innovation_items->where('status', 1)->count();
        $service_card_active_count = $service_cards->where('status', 1)->count();
        return view('admin.services.innovation.index', compact('innovation','innovation_items','active_count','service_cards','service_card_active_count'));
    }
    public function innovationEdit($id)
    {
        $innovation = InnovationService::where('id', $id)->first();

        $translations = InnovationService::Lang();
        return view('admin.services.innovation.edit', compact('translations', 'innovation'));
    }

    public function innovationShow($id)
    {
        $innovation = InnovationService::where('id', $id)->first();

        $translations = InnovationService::Lang();
        return view('admin.services.innovation.show', compact('translations', 'innovation'));
    }

    public function innovationUpdate(Request $request,$id)
    {
        $validateData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        $innovation = InnovationService::where('id', $id)->first();
        $sh = new SiteHelper();
        $sh->innovation_translate_and_save($request, $id);
        return Redirect::route('aboutUs.services.innovation.index');
    }

    public function innovationItemCreate()
    {
        return view('admin.services.innovation.items.create');
    }

    public function innovationItemSave(Request $request)
    {
        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192|required',
            'title.1' => ['required', 'max:255'],
        ]);

        $active_count = InnovationServiceItem::all()->where('status', 1)->count();


        if ($active_count < 6) {
            $innovation_item = new InnovationServiceItem();
            $image = $request->image;
            $innovation_item->status = $request->get('status');
            if ($request->get('status') == null) {
                $innovation_item->status = 1;
            }

            if (isset($image)) {
                $image_uni = uniqid('innovation_item', true) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('storage/public/images/innovation_item_images/' . $image_uni);
                $innovation_item->image = '/storage/public/images/innovation_item_images/' . $image_uni;
            }

            $created_item = $innovation_item->create(['image' => $innovation_item->image, 'status' => $innovation_item->status]);
            if ($created_item != null) {
                $sh = new SiteHelper();
                $sh->innovation_item_translate_and_save($request, $created_item->id);
            }
        }
        return Redirect::route('aboutUs.services.innovation.index');
    }

    public function innovationItemEdit($id)
    {
        $innovation_item = InnovationServiceItem::whereId($id)->first();
        $translations = InnovationServiceItem::LangSpecificId($innovation_item->id);
        return view('admin.services.innovation.items.edit', compact('translations', 'innovation_item'));
    }

    public function innovationItemShow($id)
    {
        $innovation_item = InnovationServiceItem::whereId($id)->first();
        $translations = InnovationServiceItem::LangSpecificId($innovation_item->id);
        return view('admin.services.innovation.items.show', compact('translations', 'innovation_item'));
    }

    public function innovationItemUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
        ]);
        $inno_item = InnovationServiceItem::where('id', $id)->first();

        $image = $request->image;
        $old_image = $request->old_image;
        $inno_item->status = $request->get('status');
        $innovation_items = InnovationServiceItem::languages(app()->getLocale());
        $active_count = $innovation_items->where('status', 1)->count();
        if ($request->get('status') == null) {
            $inno_item->status = 1;
        }

            if (isset($image)) {
                $image_uni = uniqid('innovation_item', true) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('storage/public/images/innovation_item_images/' . $image_uni);
                $inno_item->image = '/storage/public/images/innovation_item_images/' . $image_uni;
                if ($request->hasFile($old_image)) {
                    File::delete('storage/public/images/innovation_item_images/' . $old_image);
                }

            } else {
                $inno_item->image = $old_image;
            }
            $inno_item->save();
            $sh = new SiteHelper();
            $sh->innovation_item_translate_and_update($request, $id);
            return Redirect::route('aboutUs.services.innovation.index');

    }

    public function innovationItemDestroy($id)
    {
        InnovationServiceItem::findOrFail($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }

    public function serviceCardDestroy($id)
    {
        ServiceCard::findOrFail($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }
    public function serviceCardCreate()
    {
        return view('admin.services.innovation.cards.create');
    }

    public function serviceCardSave(Request $request)
    {
        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192|required',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required', 'min:1'],
        ]);

        $active_count = ServiceCard::all()->where('status', 1)->count();


        if ($active_count < 3) {
            $card = new ServiceCard();
            $image = $request->image;
            $card->status = $request->get('status');
            if ($request->get('status') == null) {
                $card->status = 1;
            }

            if (isset($image)) {
                $image_uni = uniqid('card', true) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('storage/public/images/service_card_images/' . $image_uni);
                $card->image = '/storage/public/images/service_card_images/' . $image_uni;
            }

            $created = $card->create(['image' => $card->image, 'status' => $card->status]);
            if ($created != null) {
                $sh = new SiteHelper();
                $sh->service_card_translate_and_save($request, $created->id);
            }
        }
        return Redirect::route('aboutUs.services.innovation.index');
    }

    public function serviceCardEdit($id)
    {
        $card = ServiceCard::whereId($id)->first();
        $translations = ServiceCard::LangSpecificId($card->id);
        return view('admin.services.innovation.cards.edit', compact('translations', 'card'));
    }
    public function serviceCardShow($id)
    {
        $card = ServiceCard::whereId($id)->first();
        $translations = ServiceCard::LangSpecificId($card->id);
        return view('admin.services.innovation.cards.show', compact('translations', 'card'));
    }

    public function serviceCardUpdate(Request $request,$id)
    {
        $validatedData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        $card = ServiceCard::where('id', $id)->first();

        $image = $request->image;
        $old_image = $request->old_image;
        $card->status = $request->get('status');
        if ($request->get('status') == null) {
            $card->status = 1;
        }

        if (isset($image)) {
            $image_uni = uniqid('experience', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/service_card_images/' . $image_uni);
            $card->image = '/storage/public/images/service_card_images/' . $image_uni;
            if ($request->hasFile($old_image)) {
                File::delete('storage/public/images/service_card_images/' . $old_image);
            }


        } else {
            $card->image = $old_image;
        }
        $card->save();
        $sh = new SiteHelper();
        $sh->service_card_translate_and_update($request, $id);
        return Redirect::route('aboutUs.services.innovation.index');
    }
}
