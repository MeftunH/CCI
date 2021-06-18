<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsIntro;
use App\Models\NewsTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{

    public function index()
    {
        $intro = NewsIntro::languages(app()->getLocale());
        $news = News::languages(app()->getLocale());
        return view('admin.news.intro.index', compact('intro','news'));
    }

    public function newsCreate()
    {
        return view('admin.news.create');
    }

    public function newsSave(Request $request)
    {
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192|required',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required', 'min:1'],
        ]);

            $news = new News();
            $image = $request->background_image;
            $news->status = $request->get('status');
            if ($request->get('status') == null) {
                $news->status = 1;
            }

            if (isset($image)) {
                $image_uni = uniqid('news', true) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('storage/public/images/news_images/' . $image_uni);
                $news->image = '/storage/public/images/news_images/' . $image_uni;
            }

            $news = $news->create(['image' => $news->image, 'status' => $news->status]);
            if ($news != null) {
                $sh = new SiteHelper();
                $sh->news_translate_and_save($request, $news->id);
            }
        return Redirect::route('news.index');
    }

    public function newsEdit($id)
    {
        $news = News::where('id',$id)->first();
        $translations = NewsTranslation::where('news_id', $id)->get();
        return view('admin.news.edit', compact('translations', 'news'));

    }

    public function newsUpdate(Request $request,$id)
    {
        $validatedData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        $news = News::where('id', $id)->first();

        $image = $request->image;
        $old_image = $request->old_image;
        $news->status = $request->get('status');
        if ($request->get('status') == null) {
            $news->status = 1;
        }

        if (isset($image)) {
            $image_uni = uniqid('news', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/news_images/' . $image_uni);
            $news->image = '/storage/public/images/news_images/' . $image_uni;
            if ($request->hasFile($old_image)) {
                File::delete('storage/public/images/news_images/' . $old_image);
            }


        } else {
            $news->image = $old_image;
        }
        $news->save();
        $sh = new SiteHelper();
        $sh->news_translate_and_update($request, $id);
        return Redirect::route('news.index');
    }

    public function show($id)
    {
        $intro = NewsIntro::where('id', $id)->first();

        $translations = NewsIntro::Lang();
        return view('admin.news.intro.show', compact('translations', 'intro'));
    }

    public function edit($id)
    {
        $intro = NewsIntro::where('id', $id)->first();

        $translations = NewsIntro::Lang();
        return view('admin.news.intro.edit', compact('translations', 'intro'));
    }

    public function update(Request $request, $id)
    {
        $intro= NewsIntro::where('id', $id)->first();
        $translations = NewsIntro::langSpecificId($intro->id);

        $data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);

        if (isset($image)) {
            $image_uni = uniqid('news_intro', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/news_intro_images/' . $image_uni);
            $intro->background_image = '/storage/public/images/news_intro_images/' . $image_uni;
            $intro->save();
            if (File::exists(public_path($old_image))) {
                File::delete(public_path($old_image));
            }
        } else {
            $data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->news_intro_translate_and_save($request, $id);
        return Redirect::route('news.index');
    }


}
