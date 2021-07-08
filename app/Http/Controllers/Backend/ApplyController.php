<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\ApplyIntro;
use App\Models\ConnectIntro;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class ApplyController extends Controller
{
    public function saveApply(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'phone_number' => 'max:20',
        ]);

        $apply = new Apply;

        $apply->name = $request->name;
        $apply->surname = $request->surname;
        $apply->email = $request->email;
        $apply->phone_number = $request->phone_number;


        $apply->save();
        Mail::send('emails.apply_email',
            array(
                'name' => $request->get('name'),
                'surname' => $request->get('surname'),
                'email' => $request->get('email'),
                'phone_number' => $request->get('phone_number'),
            ), function($message) use ($request)
            {
                $message->from($request->email);
                $message->to(\App\Models\Mail::where('type',1)->first()->mail)->subject
                (trans('mail.apply_request'));

            });
        if (Mail::failures()) {
            return back()->with('error', ':(');
//            Alert::success('Success Title', 'Success Message');
        } else
        {
            return back()->with('success', ':)');
//            Alert::error('Error Title', 'Success Message');

        }


    }
    public function index()
    {
        $intro = ApplyIntro::languages(app()->getLocale());
        $mails = Apply::orderBy('id','desc')->paginate(10);
        return view('admin.apply.intro.index', compact('intro','mails'));
    }
    public function edit($id)
    {
        $intro = ApplyIntro::where('id', $id)->first();

        $translations = ApplyIntro::Lang();
        return view('admin.apply.intro.edit', compact('translations', 'intro'));
    }
    public function show($id)
    {
        $intro = ApplyIntro::where('id', $id)->first();

        $translations = ApplyIntro::Lang();
        return view('admin.apply.intro.show', compact('translations', 'intro'));
    }
    public function update(Request $request, $id)
    {
        $intro= ApplyIntro::where('id', $id)->first();
        $translations = ApplyIntro::langSpecificId($intro->id);

        $data = array();
        $image = $request->background_image;
        $old_image = $request->old_image;
        $validateData = $request->validate([
            'background_image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);

        if (isset($image)) {
            $image_uni = uniqid('apply_intro', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/apply_intro_images/' . $image_uni);
            $intro->background_image = '/storage/public/images/apply_intro_images/' . $image_uni;
            $intro->save();
            if (File::exists(public_path($old_image))) {
                File::delete(public_path($old_image));
            }
        } else {
            $data['background_image'] = $old_image;
        }
        $sh = new SiteHelper();
        $sh->apply_intro_translate_and_save($request, $id);
        return Redirect::route('applies.index');
    }

}
