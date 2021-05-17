<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;


class LanguageController extends Controller
{
    public function create()
    {
        return view('admin.language.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'locale' => 'required',
            'flag' => 'required|mimes:jpg,png,jpeg|max:5048',
        ]);

        $input = $request->all();

        //If status is default then gimme status to active
        if ($request->status == null) {
            $request->status = 1;
        }

        if ($request->hasFile('flag')) {
            $destination_path = 'public/images/flag_img';
            $image = $request->file('flag');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('flag')->storeAs($destination_path, $image_name);

            $input['flag'] = $image_name;
        }

        Language::create($input);
        return view('admin.index');
    }
}
