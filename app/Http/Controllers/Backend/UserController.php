<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function updateProfileImage(Request $request)
    {

        $user = Auth::user();
        if ($request->ajax()) {
            $data = $request->file('file');
            $image_uni = uniqid('avatar', true) . '.' . $data->getClientOriginalExtension();
            if (File::exists($user->photo)) {
                unlink($user->photo);
            }
        }
        Image::make($data)->save('storage/public/images/avatar/' . $image_uni);
        $user->photo = '/storage/public/images/avatar/' . $image_uni;
        $user->save();

        return response()->json([
            'success' => 'done',

        ]);


    }
}
