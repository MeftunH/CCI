<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\Future;
use App\Models\FutureItem;
use App\Models\FutureItemTranslation;
use App\Models\FutureList;
use App\Models\FutureListTranslation;
use App\Scopes\ActiveScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class FutureController extends Controller
{

    public function index()
    {
        $future = Future::all()->first();
        $futureItems = FutureItem::select('*')->withoutGlobalScope(ActiveScope::class)->get();
        $active_count = FutureItem::all()->count();
        $list_active_count = FutureList::all()->count();
        $future_list_items = FutureList::select('*')->withoutGlobalScope(ActiveScope::class)->get();
        return view('admin.aboutUs.future.index', compact('future_list_items','list_active_count','future', 'futureItems', 'active_count'));
    }

    public function show($id)
    {
        $future = Future::where('id', $id)->first();

        $translations = Future::all()->first();
//        dd($translations);
        return view('admin.aboutUs.future.show', compact('translations', 'future'));
    }
    public function edit($id)
    {
        $future = Future::where('id', $id)->first();

        $translations = Future::all()->first();
        return view('admin.aboutUs.future.edit', compact('translations', 'future'));
    }
    public function update(Request $request, $id)
    {
        $sh = new SiteHelper();
        $sh->future_translate_and_save($request, $id);
        return Redirect::route('aboutUs.future.index');
    }

    public function futureItemCreate()
    {
        return view('admin.aboutUs.future.items.create');
    }
    public function futureItemSave(Request $request)
    {
        $active_count = FutureItem::all()->count();
        if ($active_count < 4) {
            $validateData = $request->validate([
                'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192|required',
            ]);

            $image = $request->background_image;
            $future_item = new FutureItem();
            if ($request->get('status') == null) {
                $future_item->status = 1;
            }
            if (isset($image)) {
                $image_uni = uniqid() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('storage/public/images/future_images/' . $image_uni);
                $future_item->background_image = '/storage/public/images/future_images/' . $image_uni;
                $future_item->status = $request->get('status');
                $fi = $future_item->create(['image' => $future_item->background_image, 'status' => $future_item->status]);
                $future_item_translation = new FutureItem();

                $future_item_translation->title = $request->title;
                $sh = new SiteHelper();
                $sh->future_item_translate_and_save($request, $fi->id);
            }
        } else {
            return Redirect::back()->withErrors([trans('already_has_4_item')]);
        }

        return Redirect::route('aboutUs.future.index');
    }
    public function futureItemShow($id)
    {
        $futureItem = FutureItem::where('id', $id)->select('*')->withoutGlobalScope(ActiveScope::class)->first();
        $translations = FutureItemTranslation::where('future_item_id', $id)->withoutGlobalScope(ActiveScope::class)->get();
        return view('admin.aboutUs.future.items.show', compact('translations', 'futureItem'));
    }
    public function futureItemEdit($id)
    {
        $future = FutureItem::select('*')->withoutGlobalScope(ActiveScope::class)->where('id', $id)->first();
        $translations = FutureItemTranslation::where('future_item_id', $id)->get();
        return view('admin.aboutUs.future.items.edit', compact('translations', 'future'));
    }
    public function futureItemUpdate($id, Request $request)
    {
        $future_item = new FutureItem();
        $future_item->exists = true;
        $future_item->id = $id;
        $translations = FutureItemTranslation::where('future_item_id', $id)->get();


        $image = $request->image;
        $old_image = $request->old_image;

        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);

        if (isset($image)) {
            $image_uni = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/future_images/' . $image_uni);
            $future_item->image = '/storage/public/images/future_images/' . $image_uni;
//            unlink($old_image);
        } else {
            $future_item->image = $old_image;
        }

        if ($request->get('status') == null) {
            $status = 0;
        } else {
            $status = request('status');
        }
        $future_item->status = $status;
        $future_item->save();
        $sh = new SiteHelper();
        $sh->future_item_translate_and_update($request, $id);

        return Redirect::route('aboutUs.future.index');
    }
    public function futureItemDestroy($id)
    {
        FutureItem::find($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }
    public function futureListItemCreate()
    {
        return view('admin.aboutUs.future.list_items.create');
    }

    public function futureListItemSave(Request $request)
    {


        $active_count = FutureList::all()->count();
        if ($active_count < 3) {

            $future_list_item = new FutureList();
            if ($request->get('status') == null) {
                $future_list_item->status = 1;
            } else {
                $future_list_item->status = $request->get('status');
            }

            $fi = $future_list_item->create(['status' => $future_list_item->status]);

            $future_list_item_translation = new FutureList();
            $future_list_item_translation->title=$request->title;
            $future_list_item_translation->description=$request->description;
            $sh = new SiteHelper();
            $sh->future_list_item_translate_and_save($request, $fi->id);

        } else {
            return Redirect::back()->withErrors([trans('already_has_3_item')]);
        }

        return Redirect::route('aboutUs.future.index');
    }
    public function futureListItemShow($id)
    {
        $future = FutureList::select('*')->withoutGlobalScope(ActiveScope::class)->where('id', $id)->first();
        $translations = FutureListTranslation::where('future_list_id', $id)->get();
        return view('admin.aboutUs.future.list_items.show', compact('translations', 'future'));
    }
    public function futureListItemEdit($id)
    {
        $future = FutureList::select('*')->withoutGlobalScope(ActiveScope::class)->where('id', $id)->first();
        $translations = FutureListTranslation::where('future_list_id', $id)->get();
        return view('admin.aboutUs.future.list_items.edit', compact('translations', 'future'));
    }
    public function futureListItemUpdate($id, Request $request)
    {
        $future_liste_item = new FutureList();
        $future_liste_item->exists = true;
        $future_liste_item->id = $id;
        $translations = FutureListTranslation::where('future_list_id', $id)->get();


        if ($request->get('status') == null) {
            $status = 0;
        } else {
            $status = request('status');
        }
        $future_liste_item->status = $status;
        $future_liste_item->save();
        $sh = new SiteHelper();
        $sh->future_list_item_translate_and_update($request, $id);

        return Redirect::route('aboutUs.future.index');
    }
    public function futureListItemDestroy($id)
    {
        FutureList::find($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }
    public function destroy($id)
    {
        //
    }
}
