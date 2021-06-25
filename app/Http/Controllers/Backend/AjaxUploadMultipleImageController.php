<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class AjaxUploadMultipleImageController extends Controller
{
    public function saveUpload(Request $request)
    {

        dd($request->all());
        $validatedData = $request->validate([
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);

        if($request->TotalImages > 0)
        {

            for ($x = 0; $x < $request->TotalImages; $x++)
            {

                if ($request->hasFile('images'.$x))
                {
                    $file      = $request->file('images'.$x);

                    $path = $file->store('public/images');
                    $name = $file->getClientOriginalName();

                    $insert[$x]['image_path'] = $name;
                }
            }

            Image::insert($insert);

            return response()->json(['success'=>'Multiple Image has been uploaded into db and storage directory']);


        }
        else
        {
            return response()->json(["message" => "Please try again."]);
        }

    }
}
