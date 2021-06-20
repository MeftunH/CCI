<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventIntro;
use App\Models\EventTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{

    public function index()
    {
        $intro = EventIntro::languages(app()->getLocale());
        $events = Event::languages(app()->getLocale())->paginate(5);

        return view('admin.events.intro.index', compact('intro','events'));
    }

    public function show($id)
    {
        $intro = EventIntro::where('id', $id)->first();

        $translations = EventIntro::Lang();
        return view('admin.events.intro.show', compact('translations', 'intro'));
    }

    public function edit($id)
    {
        $intro = EventIntro::where('id', $id)->first();

        $translations = EventIntro::Lang();
        return view('admin.events.intro.edit', compact('translations', 'intro'));
    }

    public function update(Request $request, $id)
    {
        $intro= EventIntro::where('id', $id)->first();
        $translations = EventIntro::langSpecificId($intro->id);

        $data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);

        if (isset($image)) {
            $image_uni = uniqid('events_intro', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/events_intro_images/' . $image_uni);
            $intro->background_image = '/storage/public/images/events_intro_images/' . $image_uni;
            $intro->save();
            if (File::exists(public_path($old_image))) {
                File::delete(public_path($old_image));
            }
        } else {
            $data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->events_intro_translate_and_save($request, $id);
        return Redirect::route('events.index');
    }

    public function eventCreate()
    {
        return view('admin.events.create');
    }

    public function eventSave(Request $request)
    {
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192|required',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required', 'min:1'],
        ]);

        $news = new Event();
        $image = $request->background_image;
        $news->status = $request->get('status');
        if ($request->get('status') == null) {
            $news->status = 1;
        }

        if (isset($image)) {
            $image_uni = uniqid('events', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/event_images/' . $image_uni);
            $news->image = '/storage/public/images/event_images/' . $image_uni;
        }

        $news = $news->create(['image' => $news->image, 'status' => $news->status]);
        if ($news != null) {
            $sh = new SiteHelper();
            $sh->event_translate_and_save($request, $news->id);
        }
        return Redirect::route('events.index');
    }

    public function eventEdit($id)
    {
        $event = Event::where('id',$id)->first();
        $translations = EventTranslation::where('event_id', $id)->get();
        return view('admin.events.edit', compact('translations', 'event'));
    }
    public function eventShow($id)
    {
        $event = Event::where('id',$id)->first();
        $translations = EventTranslation::where('event_id', $id)->get();
        return view('admin.events.show', compact('translations', 'event'));
    }

    public function eventUpdate(Request $request,$id)
    {
        $validatedData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        $news = Event::where('id', $id)->first();

        $image = $request->image;
        $old_image = $request->old_image;
        $news->status = $request->get('status');
        if ($request->get('status') == null) {
            $news->status = 1;
        }

        if (isset($image)) {
            $image_uni = uniqid('news', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/event_images/' . $image_uni);
            $news->image = '/storage/public/images/event_images/' . $image_uni;
            if ($request->hasFile($old_image)) {
                File::delete('storage/public/images/event_images/' . $old_image);
            }


        } else {
            $news->image = $old_image;
        }
        $news->save();
        $sh = new SiteHelper();
        $sh->event_translate_and_update($request, $id);
        return Redirect::route('events.index');
    }

    public function eventDestroy($id)
    {
        $event = Event::findOrFail($id);
        if (File::exists(public_path($event->image))) {
            File::delete(public_path($event->image));
        }
        $event->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }
}
