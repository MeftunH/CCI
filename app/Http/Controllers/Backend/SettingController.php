<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Models\Mail;
use App\Models\Setting;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::firstOrFail();
        $socials = Social::all();
        $mails = Mail::all();
//        dd($aboutUs);
//        $aboutUs=AboutUsTranslation::languages();
        return view('admin.settings.index', compact('settings','socials','mails'));
    }

    public function edit($id)
    {
        $settings = Setting::where('id',$id)->firstOrFail();
        return view('admin.settings.edit', compact('settings'));
    }

    public function show($id)
    {
        $settings = Setting::where('id',$id)->firstOrFail();
        return view('admin.settings.show', compact('settings'));
    }

    public function update(Request $request,$id)
    {
        $validateData = $request->validate([
            'admin_panel_logo' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'admin_panel_icon' => 'mimes:jpeg,jpg,png,gif,svg,ico|max:8192',
            'index_footer_logo' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'non_index_footer_logo' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'index_navbar_logo' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'non_index_navbar_logo' => 'mimes:jpeg,jpg,png,gif,svg|max:8192',
            'frontend_icon' => 'mimes:jpeg,jpg,png,gif,svg,ico|max:8192',
            'mail' => 'required|email',
        ]);
        $sh = new SiteHelper();
        $obj = Setting::where('id', $id)->firstOrFail();
        $arr_data = 'admin_panel_logo_old_image';
        $item = 'admin_panel_logo';
        if ($request->mail != null) {
            $obj->mail = $request->mail;
            $obj->save();
        }
        $sh->image_update($request->admin_panel_logo,$obj,$request->admin_panel_logo_old_image,$arr_data,$item);

        $arr_data = 'admin_panel_logo_old_icon';
        $item = 'admin_panel_icon';
        $sh->image_update($request->admin_panel_icon,$obj,$request->admin_panel_icon_old_image,$arr_data,$item);

        $arr_data = 'index_footer_old_logo_upload';
        $item = 'index_footer_logo';
        $sh->image_update($request->index_footer_logo,$obj,$request->index_footer_old_logo_upload,$arr_data,$item);

        $arr_data = 'frontend_icon_upload_old_image';
        $item = 'frontend_icon';
        $sh->image_update($request->frontend_icon,$obj,$request->frontend_icon_upload_old_image,$arr_data,$item);

        $arr_data = 'non_index_footer_logo_upload_old_image';
        $item = 'non_index_footer_logo';
        $sh->image_update($request->non_index_footer_logo,$obj,$request->non_index_footer_logo_upload_old_image,$arr_data,$item);

        $arr_data = 'index_navbar_logo_upload_old_image';
        $item = 'index_navbar_logo';
        $sh->image_update($request->index_navbar_logo,$obj,$request->index_navbar_logo_upload_old_image,$arr_data,$item);

        $arr_data = 'non_index_navbar_logo_upload_old_image';
        $item = 'non_index_navbar_logo';
        $sh->image_update($request->non_index_navbar_logo,$obj,$request->non_index_navbar_logo_upload_old_image,$arr_data,$item);

        return redirect()->route('settings.index');
    }


}
