<?php

namespace App\Http\Controllers;

use App\Helpers\LanguageHelper;
use App\Models\AboutUsTranslation;
use App\Models\AreaTranslation;
use App\Models\CategoryTranslation;
use App\Models\Language;
use App\Models\LongTermItemTranslation;
use App\Models\LongTermTranslation;
use App\Models\PostTranslation;
use App\Models\SubCategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Stichoza\GoogleTranslate\GoogleTranslate;


class LanguageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:language-list|language-create|language-edit|language-delete', ['only' => ['index','show']]);
        $this->middleware('permission:language-create', ['only' => ['create','store']]);
        $this->middleware('permission:language-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:language-delete', ['only' => ['destroy']]);
        $this->middleware('permission:edit-translations', ['only' => ['EditTranslation']]);
    }
    public function index()
    {
        $languages = Language::paginate(5);
        return view('admin.language.index', compact('languages'));
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
        $tr = new GoogleTranslate();
        $tr->setSource();
        $tr->setUrl('http://translate.google.cn/translate_a/t');
        $arr_locales = new LaravelLocalization();
        if (in_array($request->get('locale'), $arr_locales->getSupportedLanguagesKeys())) {


            if ($request->hasFile('flag')) {
                $destination_path = 'public/images/flag_img/';
                $image = $request->file('flag');
                $image_name = uniqid() . $image->getClientOriginalName();
                $path = $image->storeAs($destination_path, $image_name);

                $input['flag'] = "/storage/public/images/flag_img/" . $image_name;
            }
            $temp = base_path();
            $uploads_dir = $temp . '/resources/lang/' . $request->get('locale');
            $chmod = 0777;
            if (!file_exists($uploads_dir)) {
                File::makeDirectory($uploads_dir, $chmod, true, true);
            } else {
                return Redirect::back()->withErrors(['This language already exist']);
            }
            $info = json_encode(['name' => $request->get('name'), 'locale' => $request->get('locale')]);
            $fopen = fopen($temp . '/resources/lang/' . $request->get('locale') . '/info.json', 'w+');
            $tr->setTarget($request->get('locale'));
            fwrite($fopen, $info);
            fclose($fopen);
            $files = scandir($temp . '/resources/lang/en');
            foreach ($files as $file) {
                if ($file != '.' && $file !== '..' && $file != 'info.json') {
                    $copy = copy($temp . '/resources/lang/en/' . $file, $temp . '/resources/lang/' . $request->get('locale') . '/' . $file);
                  $copied_file = $temp . '/resources/lang/' . $request->get('locale') . '/' . $file;
                   $members = array();
                   $exploded=array();
                   $read_file = fopen($copied_file,"r");
                   while (!feof($read_file)){
                     $members[] = fgets($read_file);

                   }
                   fclose($read_file);
                   foreach ($members as $member) {
                       $exploded[] = explode("=>", $member);
                   }
                   $keys_arr = array();
                   $vals_arr = array();
                   $transated_vals = array();
                   foreach ($exploded as $exp)
                   {
                       if (count($exp)==2) {

//                               $translated_item = $tr->translate($v);
                               $vals_arr[] = $exp[1];

                       }
                   }
                    $vals_together = implode(",", $vals_arr);
                    $translated_string = $tr->translate($vals_together);
                    dd($translated_string);
                }
            }

            if ($copy) {
                $language_first = Language::all()->first();
                $new_lang = Language::create($input);
                $about_us_intro = AboutUsTranslation::where('language_id', $language_first->id)->first();
                $code = $request->get('code');
                $tr = new GoogleTranslate();
                $tr->setSource();
                $tr->setTarget($code);

                $title = $tr->translate($about_us_intro->title);
                $init_description = $about_us_intro->descipriton;
                $result = "";
                if (strlen($about_us_intro->descipriton) > 2999) {
                    $init_description = str_split($about_us_intro->descipriton, 2999);
                    if (is_array($init_description)) {
                        foreach ($init_description as $key => $val) {
                            $result .= strip_tags($tr->translate($val));
                        }
                        $description = $result;

                    } else {
                        $description = $tr->translate($init_description);

                    }
                } else {
                    $description = $tr->translate($about_us_intro->description);

                }

                $translation = $about_us_intro->replicate();
                $translation->title = $title;
                $translation->description = $description;
                $translation->language_id = $new_lang->id;
                $translation->save();
                $lh = New LanguageHelper();
                $lh->translate_and_save_long_term($code, $language_first,$new_lang);
                $lh->translate_and_save_long_term_items($code, $language_first,$new_lang);
                $lh->translate_and_save_time_line($code, $language_first,$new_lang);
                $lh->industry_translate_and_save($code, $language_first,$new_lang);
                $lh->translate_and_save_resume_intro($code, $language_first,$new_lang);
                $lh->news_intro_translate_and_save($code, $language_first,$new_lang);
                $lh->homepage_intro_translate_and_save($code, $language_first,$new_lang);
                $lh->events_intro_translate_and_save($code, $language_first,$new_lang);
                $lh->connect_intro_translate_and_save($code, $language_first,$new_lang);
                $lh->reach_module_translate_and_save($code, $language_first,$new_lang);
                $lh->partner_intro_translate_and_save($code, $language_first,$new_lang);
                $lh->apply_intro_translate_and_save($code, $language_first,$new_lang);
                $lh->innovation_translate_and_save($code, $language_first,$new_lang);
                $lh->industry_client_translate_and_save($code, $language_first,$new_lang);
                $lh->service_translate_and_save($code, $language_first,$new_lang);
                $lh->academy_translate_and_save($code, $language_first,$new_lang);
                $lh->career_translate_and_save($code, $language_first,$new_lang);
                $lh->academy_career_translate_and_save($code, $language_first,$new_lang);
                $lh->career_consulting_translate_and_save($code, $language_first,$new_lang);
                $lh->case_study_translate_and_save($code, $language_first,$new_lang);
                $lh->operational_translate_and_save($code, $language_first,$new_lang);
                $lh->academy_card_translate_and_save($code, $language_first,$new_lang);
                $lh->career_consulting_card_translate_and_save($code, $language_first,$new_lang);
                $lh->industry_experience_translate_and_save($code, $language_first,$new_lang);
                $lh->news_translate_and_save($code, $language_first,$new_lang);
                $lh->events_translate_and_save($code, $language_first,$new_lang);
                $lh->service_card_translate_and_save($code, $language_first,$new_lang);
                $lh->future_translate_and_save($code, $language_first,$new_lang);
                $lh->industry_client_item_translate_and_save($code, $language_first,$new_lang);
                $lh->innovation_item_translate_and_save($code, $language_first,$new_lang);
                $lh->future_item_translate_and_save($code, $language_first,$new_lang);
                $lh->study_translate_and_save($code, $language_first,$new_lang);

                $lh->unlock_translate_and_save($code, $language_first,$new_lang);
                $lh->innovation_module_translate_and_save($code, $language_first,$new_lang);


                $lh->future_list_translate_and_save($code, $language_first,$new_lang);
                $lh->academy_career_item_translate_and_save($code, $language_first,$new_lang);
                $lh->career_consulting_item_translate_and_save($code, $language_first,$new_lang);


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
                return Redirect::back()->withErrors([trans('back.this_language_already_exists')]);
            }
        }
        else
        {
            return Redirect::back()->withErrors([trans('back.local_value_is_wrong')]);
        }


        return Redirect()->route('languages.index');
    }

    public function edit($id)
    {
        $language = Language::where('id', $id)->first();
        return view('admin.language.edit', compact('language'));
    }

    public function update(Request $request, $id)
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
            if (isset($oldflag)) unlink($oldflag);
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


        $q = Language::where('id', $id)->delete();

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
