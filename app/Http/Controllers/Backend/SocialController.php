<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function edit($id)
    {
        $social = Social::where('id',$id)->first();
       return view('admin.settings.social-edit',compact('social'));
    }

    public function update(Request $request,$id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'link' => 'required',
        ]);
        $social = Social::where('id',$id)->first();
        $social->update($request->all());
        return redirect()->route('settings.index');
    }
}
