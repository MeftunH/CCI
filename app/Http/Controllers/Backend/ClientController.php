<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use \App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{

    public function index()
    {
        $client = Client::all();
        return view('admin.caseStudies.clients.index',compact('client'));
    }


    public function create()
    {
        return view('admin.caseStudies.clients.create');
    }


    public function store(Request $request)
    {

        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192|required',
        ]);
        $client = new Client();
        $image = $request->background_image;
        if ($request->get('status') == null) {
            $client->status = 1;
        }
        if ($request->get('is_slide_content')) {
            $client->is_slide_content = 1;
        }
        else
        {$client->is_slide_content = 1;}
        if (isset($image)) {
            $image_uni = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/client_images/' . $image_uni);
            $client->image = '/storage/public/images/future_images/' . $image_uni;
            $client->status = $request->get('status');
            $client->create(['image' => $client->background_image, 'status' => $client->status]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
