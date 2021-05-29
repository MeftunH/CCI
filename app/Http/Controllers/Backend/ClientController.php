<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;

class ClientController extends Controller
{

    public function index()
    {
        $client = Client::select('*')->withoutGlobalScope(ActiveScope::class)->paginate(10);

        return view('admin.caseStudies.clients.index', compact('client'));
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
        $image = $request->image;

        if ($request->get('status') == null) {
            $client->status = 1;
        }
        if ($request->get('is_slide_content')) {
            $client->is_slide_content = 1;
        } else {
            $client->is_slide_content = 1;
        }

        if (isset($image)) {
            $image_uni = uniqid('client', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/client_images/' . $image_uni);
            $client->image = '/storage/public/images/client_images/' . $image_uni;
            $client->status = $request->get('status');
            $client->create(['image' => $client->image, 'status' => $client->status]);
        }
        return view('admin.caseStudies.clients.index');
    }


    public function show($id)
    {
        $client = Client::select('*')->withoutGlobalScope(ActiveScope::class)->where('id', $id)->first();
        return view('admin.caseStudies.clients.show', compact('client'));
    }

    public function add_to_slider()
    {
        $clients = Client::all();
        return view('admin.caseStudies.clients.add_to_slider', compact('clients'));
    }

    public function update_slider(Request $request)
    {

        $data=[];
        if (isset($request->is_slide_content))
        {
            foreach ($request->is_slide_content as $key=>$item) {
                $data[] = $key;
            }
        Client::wherenotIn('id', $data)->update(['is_slide_content' => 0]);
        }
        if (isset($request->is_slide_content)) {
            foreach ($request->is_slide_content as $key => $item) {
                $data[] = $key;
            }
            Client::whereIn('id', $data)->update(['is_slide_content' => 1]);

        }

        return Redirect::route('caseStudies.index');
    }

    public function edit($id)
    {
        $client = Client::select('*')->withoutGlobalScope(ActiveScope::class)->where('id', $id)->first();
        return view('admin.caseStudies.clients.edit', compact('client'));

    }


    public function update(Request $request, $id)
    {
        $client = Client::withoutGlobalScope(ActiveScope::class)->where('id', $id)->first();
        $validateData = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
        ]);
        $image = $request->image;
        $old_image = $request->old_image;
        if (isset($image)) {
            $image_uni = uniqid('client', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/future_images/' . $image_uni);
            $client->image = '/storage/public/images/future_images/' . $image_uni;
            if ($request->hasFile($old_image)) unlink($old_image);
        }
        else
        {
            $client->image = $old_image;
        }
        $client->status = $request->status;
        if ($request->status == null)
        {
            $client->status = 1;
        }
        if ($request->has('is_slide_content'))
        {
            $client->is_slide_content = 1;
        }
        else
        {
            $client->is_slide_content = 0;
        }
        $client->save();
        return Redirect::route('clients.index');
    }


    public function destroy($id)
    {

        Client::find($id)->delete();
        return back()->with('success', trans('back.deleted_successfully'));
    }
}
