<?php
namespace App\Helpers;

use App\Models\AboutUsTranslation;
use App\Models\AcademyCard;
use App\Models\AcademyCardTranslation;
use App\Models\AcademyCareer;
use App\Models\AcademyCareerItemTranslation;
use App\Models\AcademyCareerTranslation;
use App\Models\AcademyTranslation;
use App\Models\ApplyIntroTranslation;
use App\Models\Career;
use App\Models\CareerConsulting;
use App\Models\CareerConsultingCardTranslation;
use App\Models\CareerConsultingItemTranslation;
use App\Models\CareerConsultingTranslation;
use App\Models\CareerTranslation;
use App\Models\CaseStudyTranslations;
use App\Models\ConnectIntroTranslation;
use App\Models\EventIntro;
use App\Models\EventIntroTranslation;
use App\Models\EventTranslation;
use App\Models\FutureItemTranslation;
use App\Models\FutureList;
use App\Models\FutureListTranslation;
use App\Models\FutureTranslation;
use App\Models\IndustryClientItemTranslation;
use App\Models\IndustryClientTranslation;
use App\Models\IndustryExperience;
use App\Models\IndustryExperienceTranslation;
use App\Models\IndustryTranslation;
use App\Models\InnovationServiceItemTranslation;
use App\Models\InnovationServiceTranslation;
use App\Models\Language;
use App\Models\LongTermItemTranslation;
use App\Models\LongTermTranslation;
use App\Models\NewsIntroTranslation;
use App\Models\NewsTranslation;
use App\Models\OperationalTranslation;
use App\Models\PartnerIntroTranslation;
use App\Models\ReachModule;
use App\Models\ReachModuleTranslation;
use App\Models\ServiceCard;
use App\Models\ServiceCardTranslation;
use App\Models\ServiceTranslation;
use App\Models\Study;
use App\Models\StudyTranslation;
use App\Models\TimeLineTranslation;
use App\Models\UploadResume;
use App\Models\UploadResumeTranslation;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Stichoza\GoogleTranslate\GoogleTranslate;

class SiteHelper
{


    public function image_update($image,$obj,$old_image,$arr_data,$item)
    {
        if (isset($image)) {
            $image_uni = uniqid('', true) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('storage/public/images/setting_images/' . $image_uni);
            $data[$arr_data] = '/storage/public/images/setting_images/' . $image_uni;
            $obj->$item = $data[$arr_data];
            $obj->save();
            $old_path = 'storage/public/images/setting_images/'.$old_image;
            if (File::exists($old_path)) {
                File::delete($old_path);
            }
        } else {
            $data[$arr_data] = $old_image;
        }
    }

    //at least delete
    public function translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = AboutUsTranslation::where('aboutUs_id', $id)->where('language_id', $language)->first();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
                'description.1' => ['required'],
            ]);
            $currLang = Language::where('id', $language)->first();
            $description = $request->description[$language];
            $init_description = $request->input("description.1");
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }
    public function resume_intro_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = UploadResumeTranslation::where('item_id', $id)->where('language_id', $language)->first();

            $currLang = Language::where('id', $language)->first();
            $footer = $request->footer[$language];
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            if ($footer == null) {
                $footer = $tr->translate($request->input("footer.1"));
            }

            $translation->title = $title;
            $translation->description = $description;
            $translation->footer = $footer;
            $translation->item_id = $id;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function industry_translate_and_save($request, $id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = IndustryTranslation::where('industry_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }
    public function news_intro_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = NewsIntroTranslation::where('intro_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }
    public function events_intro_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = EventIntroTranslation::where('intro_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }
    public function connect_intro_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = ConnectIntroTranslation::where('intro_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }
    public function reach_module_translate_and_save($request, $id)
    {
        foreach ($request->working_hours as $language => $working_hours) {
            $translation = ReachModuleTranslation::where('module_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $address = ($request->address[$language]);
            $init_description = ($request->input("address.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("address.1")) > 2999) {
                $init_description = str_split($request->input("address.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($working_hours == null && $address != null) {
                $working_hours = $tr->translate($request->input("working_hours.1"));
            } else if ($working_hours != null && $address == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $address = $result;

                } else {
                    $address = ($tr->translate($init_description));
                }
            } else if ($working_hours == null && $address == null) {
                $working_hours = $tr->translate($request->input("working_hours.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $address = $result;
                } else {
                    $address = $tr->translate($init_description);
                }
            }

            $translation->address = $address;
            $translation->working_hours = $working_hours;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }
    public function partner_intro_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = PartnerIntroTranslation::where('intro_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }
    public function apply_intro_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = ApplyIntroTranslation::where('intro_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function innovation_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = InnovationServiceTranslation::where('innovation_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = $request->description[$language];
            $init_description = $request->input("description.1");
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function industry_client_translate_and_save($request, $id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = IndustryClientTranslation::where('industry_client_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function service_translate_and_save($request, $id)
    {

        foreach ($request->title as $language => $title) {
            $translation = ServiceTranslation::where('service_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function academy_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = AcademyTranslation::where('academy_id', $id)->where('language_id', $language)->first();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
                'description.1' => ['required'],
            ]);
            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function career_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = CareerTranslation::where('career_id', $id)->where('language_id', $language)->first();

            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function academy_career_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = AcademyCareerTranslation::where('ac_id', $id)->where('language_id', $language)->first();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
                'description.1' => ['required'],
            ]);
            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = $request->input("description.1");
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;

                } else {
                    $description = $tr->translate($init_description);
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            } else {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                }
            }
            $translation->title = $title;
            $translation->description = $description;

            $translation->save();
        }
    }

    public function career_consulting_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = CareerConsultingTranslation::where('cc_id', $id)->where('language_id', $language)->first();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
                'description.1' => ['required'],
            ]);
            $currLang = Language::where('id', $language)->first();
            $description = $request->description[$language];
            $init_description = $request->input("description.1");
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;

                } else {
                    $description = $tr->translate($init_description);
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            } else {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                }
            }
            $translation->title = $title;
            $translation->description = $description;

            $translation->save();
        }
    }

    public function case_study_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = CaseStudyTranslations::where('cs_id', $id)->where('language_id', $language)->first();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
                'footer.1' => ['required', 'max:255'],
                'description.1' => ['required'],
            ]);
            $currLang = Language::where('id', $language)->first();
            $footer = $request->footer[$language];
            $description = $request->description[$language];
            $init_description = $request->input("description.1");
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            if ($footer == null) {
                $footer = $tr->translate($request->input("footer.1"));
            }

            $translation->title = $title;
            $translation->description = $description;
            $translation->footer = $footer;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function operational_translate_and_save($request, $id): void
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = OperationalTranslation::where('operational_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function academy_card_translate_and_save($request, $id): void
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = new  AcademyCardTranslation();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            $translation->academy_card_id = $id;
            $translation->language_id = $language;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function career_consulting_card_translate_and_save($request, $id): void
    {
        foreach ($request->title as $language => $title) {
            $translation = new  CareerConsultingCardTranslation();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);

            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $tr->setUrl('http://translate.google.cn/translate_a/t');

            ////title

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            $translation->cc_card_id = $id;
            $translation->language_id = $language;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function industry_experience_translate_and_save($request, $id): void
    {
        foreach ($request->title as $language => $title) {
            $translation = new  IndustryExperienceTranslation();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            $translation->experience_id = $id;
            $translation->language_id = $language;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }
    public function news_translate_and_save($request, $id): void
    {
        foreach ($request->title as $language => $title) {
            $translation = new  NewsTranslation();
            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            $translation->news_id = $id;
            $translation->language_id = $language;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }
    public function event_translate_and_save($request, $id): void
    {
        foreach ($request->title as $language => $title) {
            $translation = new  EventTranslation();
            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            $translation->event_id = $id;
            $translation->language_id = $language;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function service_card_translate_and_save($request, $id): void
    {
        foreach ($request->title as $language => $title) {
            $translation = new  ServiceCardTranslation();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            $translation->service_card_id = $id;
            $translation->language_id = $language;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function future_translate_and_save($request, $id): void
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = FutureTranslation::where('future_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function long_term_translate_and_save($request, $id): void
    {
        foreach ($request->title as $language => $title) {
            $translation = LongTermTranslation::where('long_term_id', $id)->where('language_id', $language)->first();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
                'description.1' => ['required'],
            ]);
            $currLang = Language::where('id', $language)->first();
            $description = $request->description[$language];
            $init_description = $request->input("description.1");
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;

                } else {
                    $description = $tr->translate($init_description);
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }
            $translation->title = $title;
            $translation->description = $description;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function time_line_translate_and_save($request, $id): void
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
        ]);


        foreach ($request->title as $language => $title) {

            $currLang = Language::where('id', $language)->first();

            //Google translate API max limit is 4999 characters

            if ($request->title[$language] != null) {

                $titles = $request->title[$language];

            } else {

                $tr = new GoogleTranslate();
                $tr->setSource();
                $tr->setTarget($currLang->code);
                $tr->setUrl('http://translate.google.cn/translate_a/t');


                $titles = $tr->translate($request->title[1]);

            }
            $translation = new TimeLineTranslation();
            $translation->language_id = $language;
            $translation->time_line_id = $id;
            $translation->title = $titles;

            $translation->save();

        }

    }

    public function time_line_translate_and_update($request, $id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
        ]);


        foreach ($request->title as $language => $title) {
            $translation = TimeLineTranslation::where('time_line_id', $id)->where('language_id', $language)->first();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
            ]);
            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->time_line_id = $id;


            $translation->save();

        }

    }

    public function long_term_item_translate_and_save($request, $long_term_id)
    {
        foreach ($request->title as $language => $title) {
            $translation = new LongTermItemTranslation;

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
            ]);
            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->item_id = $long_term_id;

            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function industry_client_item_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = new IndustryClientItemTranslation();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
            ]);
            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->item_id = $id;

            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function innovation_item_translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = new InnovationServiceItemTranslation();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
            ]);
            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->item_id = $id;

            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }


    public function future_item_translate_and_save($request, $future_item_id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = new FutureItemTranslation();

            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->future_item_id = $future_item_id;

            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }
    public function career_consulting_card_translate_and_update($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = CareerConsultingCardTranslation::where('cc_card_id', $id)->where('language_id', $language)->first();

            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }

            $translation->update(['title' => $title, 'description' => $description, 'language_id' => $language, 'cc_card_id' => $id]);
        }
    }

    public function study_translate_and_save($request, $id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        $tr = new GoogleTranslate();
        foreach ($request->title as $language => $title) {
            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }

            $translation = new StudyTranslation;
            $translation->create(['title' => $title, 'description' => $description, 'language_id' => $language, 'study_id' => $id]);
        }

    }

    public function study_translate_and_update($request, $id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = StudyTranslation::where('study_id', $id)->where('language_id', $language)->first();

            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }

            $translation->update(['title' => $title, 'description' => $description, 'language_id' => $language, 'study_id' => $id]);
        }

    }

    public function experience_translate_and_update($request, $id)
    {

        foreach ($request->title as $language => $title) {
            $translation = IndustryExperienceTranslation::where('experience_id', $id)->where('language_id', $language)->first();

            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }

            $translation->update(['title' => $title, 'description' => $description, 'language_id' => $language, 'experience_id' => $id]);
        }

    }
    public function news_translate_and_update($request, $id)
    {

        foreach ($request->title as $language => $title) {
            $translation = NewsTranslation::where('news_id', $id)->where('language_id', $language)->first();

            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }

            $translation->update(['title' => $title, 'description' => $description, 'language_id' => $language, 'news_id' => $id]);
        }

    }
    public function event_translate_and_update($request, $id)
    {

        foreach ($request->title as $language => $title) {
            $translation = EventTranslation::where('event_id', $id)->where('language_id', $language)->first();

            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }

            $translation->update(['title' => $title, 'description' => $description, 'language_id' => $language, 'event_id' => $id]);
        }

    }

    public function service_card_translate_and_update($request, $id)
    {

        foreach ($request->title as $language => $title) {
            $translation = ServiceCardTranslation::where('service_card_id', $id)->where('language_id', $language)->first();

            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');

            if ($title == null && $description != null) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= $tr->translate($item);
                    }
                    $description = $result;
                } else {
                    $description = $tr->translate($init_description);
                }
            }

            $translation->update(['title' => $title, 'description' => $description, 'language_id' => $language, 'service_card_id' => $id]);
        }

    }

    public function long_term_item_translate_and_update($request, $long_term_id)
    {
        foreach ($request->title as $language => $title) {
            $translation = LongTermItemTranslation::where('item_id', $long_term_id)->where('language_id', $language)->first();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
            ]);
            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->item_id = $long_term_id;


            $translation->save();

        }
    }

    public function industry_client_item_translate_and_update($request, $id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = IndustryClientItemTranslation::where('item_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->item_id = $id;


            $translation->save();

        }
    }

    public function future_item_translate_and_update($request, $future_item_id)
    {
        foreach ($request->title as $language => $title) {
            $translation = FutureItemTranslation::where('future_item_id', $future_item_id)->where('language_id', $language)->first();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
            ]);
            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->future_item_id = $future_item_id;


            $translation->save();

        }
    }

    public function innovation_item_translate_and_update($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = InnovationServiceItemTranslation::where('item_id', $id)->where('language_id', $language)->first();

            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->item_id = $id;

            $translation->save();

        }
    }

    public function future_list_item_translate_and_save($request, $id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = new FutureListTranslation;


            $currLang = Language::where('id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title


            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
                $description = $tr->translate($request->input("description.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }

                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }

            }

            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $language;
            $translation->future_list_id = $id;
            if ($translation->isDirty()) {
                $translation->save();
            }
        }
    }

    public function future_list_item_translate_and_update($request, $future_list)
    {


        foreach ($request->title as $language => $title) {
            $translation = FutureListTranslation::where('future_list_id', $future_list)->where('language_id', $language)->first();
            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }
            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
                'description.1' => ['required', 'max:255'],
            ]);
            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
                $description = $tr->translate($request->input("description.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }

                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }

            }
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $language;
            $translation->future_list_id = $future_list;


            $translation->save();

        }
    }

    public function academy_card_translate_and_update($request, $id)
    {


        foreach ($request->title as $language => $title) {
            $translation = AcademyCardTranslation::where('academy_card_id', $id)->where('language_id', $language)->first();

            $description = ($request->description[$language]);
            $init_description = ($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }
            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
                'description.1' => ['required', 'max:255'],
            ]);
            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
                $description = $tr->translate($request->input("description.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= ($tr->translate($item));
                    }

                    $description = $result;

                } else {
                    $description = ($tr->translate($init_description));
                }

            }
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $language;
            $translation->academy_card_id = $id;


            $translation->save();

        }
    }

    public function academy_career_item_translate_and_save($request, $id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = new AcademyCareerItemTranslation();

            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->item_id = $id;

            $translation->save();

        }
    }

    public function career_consulting_item_translate_and_save($request, $id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = new CareerConsultingItemTranslation();

            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->item_id = $id;

            $translation->save();

        }
    }

    public function academy_career_item_translate_and_update($request, $id)
    {
        foreach ($request->title as $language => $title) {

            $translation = AcademyCareerItemTranslation::where('item_id', $id)->where('language_id', $language)->first();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
            ]);
            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->item_id = $id;


            $translation->save();

        }
    }

    public function career_consulting_item_translate_and_update($request, $id)
    {
        foreach ($request->title as $language => $title) {

            $translation = CareerConsultingItemTranslation::where('item_id', $id)->where('language_id', $language)->first();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
            ]);
            $currLang = Language::where('id', $language)->first();

            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            ////title
            if ($title == null) {
                $title = $tr->translate($request->input("title.1"));
            } else {
                $translation->title = $title;
            }
            $translation->title = $title;
            $translation->language_id = $language;
            $translation->item_id = $id;


            $translation->save();

        }
    }


}

?>
