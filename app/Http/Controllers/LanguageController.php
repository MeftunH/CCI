<?php

namespace App\Http\Controllers;

use App\Models\AreaTranslation;
use App\Models\CategoryTranslation;
use App\Models\Language;
use App\Models\PostTranslation;
use App\Models\SubCategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::paginate(5);
        return view('admin.language.index',compact('languages'));
    }

    public function show()
    {

    }
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
        if ($request->get('status') == null) {
            $input['status'] = 1;
        }

        if ($request->hasFile('flag')) {
            $destination_path = 'public/images/flag_img/';
            $image = $request->file('flag');
            $image_name = uniqid().$image->getClientOriginalName();
            $path = $image->storeAs($destination_path, $image_name);

            $input['flag'] = "/storage/public/images/flag_img/".$image_name;
        }
        $temp = base_path();
        $uploads_dir = $temp . '/resources/lang/' . $request->get('locale');
        $chmod = 0777;
        if (!file_exists($uploads_dir)) {
            File::makeDirectory($uploads_dir, $chmod, true, true);
        } else {
            return Redirect::back()->withErrors(['This language already exist']);
        }
        $info = json_encode(['name' =>  $request->get('name'), 'locale' => $request->get('locale')]);
        $fopen = fopen($temp . '/resources/lang/' .$request->get('locale') . '/info.json', 'w+');
        fwrite($fopen, $info);
        fclose($fopen);
        $files = scandir($temp . '/resources/lang/en');
        foreach ($files as $file) {
            if ($file != '.' && $file !== '..' && $file != 'info.json') {
                $copy = copy($temp . '/resources/lang/en/' . $file, $temp . '/resources/lang/' . $request->get('locale') . '/' . $file);
            }
        }

        if ($copy) {
            Language::create($input);
//            $post = PostTranslation::where('language_id', $defaultLanguage->id)->get();
//            $category = CategoryTranslation::where('language_id', $defaultLanguage->id)->get();
//            $subcategory = SubCategoryTranslation::where('language_id', $defaultLanguage->id)->get();
//            $area = AreaTranslation::where('language_id', $defaultLanguage->id)->get();
//
//            foreach ($category as $item) {
//                $rep = $item->replicate();
//                $rep->language_id = $language->id;
//                $rep->save();
//            }
//            foreach ($subcategory as $item) {
//                $rep = $item->replicate();
//                $rep->language_id = $language->id;
//                $rep->save();
//            }
//            foreach ($post as $item) {
//                $rep = $item->replicate();
//                $rep->language_id = $language->id;
//                $rep->save();
//            }
//            foreach ($area as $item) {
//                $rep = $item->replicate();
//                $rep->language_id = $language->id;
//                $rep->save();
//            }
        } else {
            return Redirect::back()->withErrors(['This language already exist']);
        }


        return Redirect()->route('languages.index');
    }

    public function edit($id)
    {
        $language = Language::where('id',$id)->first();
        return view('admin.language.edit',compact('language'));
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:255',
            'name' => 'required|max:255',
            'locale' => 'required|max:255',
            'status' => 'boolean',
        ]);
        if ($validator->fails()) {
            return redirect(route('languages.edit'))
                ->withErrors($validator)
                ->withInput();
        }
        $language = Language::find($id);
        $language->code = $request->input('code');
        $language->name = $request->input('name');
        $language->locale = $request->input('locale');
        if ($request->get('status') == null) {
            $status = 0;
        } else {
            $status = request('status');
        }
        $language->status = $status;
        $oldflag = $request->oldflag;
        $image = $request->flag;
        if ($image) {
            $image_uni = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(50, 50)->save('storage/public/images/flag_img/' . $image_uni);
            $language->flag = '/storage/public/images/flag_img/' . $image_uni;
            $language->save();
            if (isset($oldflag))   unlink($oldflag);
            $notification = array(
                'message' => 'Language Edited successfully',
                'alert-type' => 'success'
            );

            return Redirect()->route('languages.index')->with($notification);
        } else {
            $data['flag'] = $oldflag;
            $language->save();
            $notification = array(
                'message' => 'Language Edited successfully',
                'alert-type' => 'success'
            );

        }
        return Redirect()->route('languages.index');
    }
    public function destroy($id)
    {
        $language = Language::find($id);

        if (isset($language->flag)) {
//            unlink($language->flag);
        }
        $languages = Language::orderBy('locale', 'asc')->get();
        $pathUpload = 'backend/assets/uploads/';


        $path = base_path() . '/resources/lang/' . $language->locale;
        if (is_dir($path)) {
            if ($language->local != 'en') {

                //delete directories
                File::deleteDirectory($path);
            }
        }


       $q= Language::where('id', $id)->delete();

        $notification = array(
            'message' => 'Language Deleted successfully',
            'alert-type' => 'error'
        );


        return Redirect()->route('languages.index')->with($notification);
    }
    public function EditTranslation(Request $request)
    {


            $locale_req = $request->input('edit');
            $language = DB::table('languages')->where('locale', $locale_req)->first();
            $folder = $language->locale;
            $file = (!is_null($request->input('file')) ? $request->input('file') : 'auth.php');
            $files = scandir(base_path() . '/resources/lang/' . $folder . '/');
//        dd($file);
            $str = File::getRequire(base_path() . '/resources/lang/' . $folder . '/' . $file);
            $data = [
                'file' => $file,
                'files' => $files,
                'lang' => $language->locale,
                'stringLangs' => $str,
            ];
            return view('admin.translations.edit', compact('language', 'data'));

    }
    public function SaveTranslation(Request $request)
    {


        $input = $request->all();

        $form = "<?php \n";
        $form .= "return [ \n";
        foreach ($_POST as $key => $val) {
            if ($key != '_token' && $key != 'flag' && $key != 'lang' && $key != 'file' && $key != 'site_title' && $key != 'site_description' && $key != 'site_keywords') {
                if (!is_array($val)) {
                    $form .= '"' . $key . '" => "' . strip_tags($val) . '", ' . " \n";
                }
            }
        }
        $form .= "'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
     'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
     'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
       'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],

    'custom' => [
        'attribute-name' => [
                'rule-name' => 'custom-message',
        ],
    ],
     'attributes' => [],";
        $form .= "]; \n";

        $lang = $request->input('lang');
        $file = $request->input('file');
        $fileName = base_path() . '/resources/lang/' . $lang . '/' . $file;
        $fp = fopen($fileName, "w+");
        fwrite($fp, $form);
        fclose($fp);
        return redirect()->back();

    }

}
