<?php
namespace App\Helpers;

use App\Models\AboutUsTranslation;
use App\Models\CaseStudyTranslations;
use App\Models\FutureItemTranslation;
use App\Models\FutureList;
use App\Models\FutureListTranslation;
use App\Models\FutureTranslation;
use App\Models\Language;
use App\Models\LongTermItemTranslation;
use App\Models\LongTermTranslation;
use App\Models\OperationalTranslation;
use App\Models\TimeLineTranslation;
use Illuminate\Database\Eloquent\Model;
use Stichoza\GoogleTranslate\GoogleTranslate;

class SiteHelper
{
    public static function test()
    {
        echo 'HELLO';
    }

    public function translate_and_save($request, $id)
    {
        foreach ($request->title as $language => $title) {
            $translation = AboutUsTranslation::where('aboutUs_id', $id)->where('language_id', $language)->first();

            $validatedData = $request->validate([
                'title.1' => ['required', 'max:255'],
                'description.1' => ['required'],
            ]);
            $currLang = Language::where('id', $language)->first();
            $description = strip_tags($request->description[$language]);
            $init_description = strip_tags($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            ////title


            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= strip_tags($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = strip_tags($tr->translate($init_description));
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
            $description = strip_tags($request->description[$language]);
            $init_description = strip_tags($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            ////title


            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= strip_tags($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = strip_tags($tr->translate($init_description));
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
            if ($footer == null)
            {
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
    public function operational_translate_and_save($request, $id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = OperationalTranslation::where('operational_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = strip_tags($request->description[$language]);
            $init_description = strip_tags($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            ////title


            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= strip_tags($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = strip_tags($tr->translate($init_description));
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

    public function future_translate_and_save($request, $id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = FutureTranslation::where('future_id', $id)->where('language_id', $language)->first();


            $currLang = Language::where('id', $language)->first();
            $description = strip_tags($request->description[$language]);
            $init_description = strip_tags($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            ////title


            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= strip_tags($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = strip_tags($tr->translate($init_description));
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

    public function long_term_translate_and_save($request, $id)
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

    public function time_line_translate_and_save($request, $id)
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

    public function future_list_item_translate_and_save($request, $id)
    {
        $validatedData = $request->validate([
            'title.1' => ['required', 'max:255'],
            'description.1' => ['required'],
        ]);
        foreach ($request->title as $language => $title) {
            $translation = new FutureListTranslation;


            $currLang = Language::where('id', $language)->first();
            $description = strip_tags($request->description[$language]);
            $init_description = strip_tags($request->input("description.1"));
            $result = "";
            //Google translate API max limit is 4999 characters
            if (strlen($request->input("description.1")) > 2999) {
                $init_description = str_split($request->input("description.1"), 2999);
            }

//            dd($description);
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($currLang->code);
            ////title


            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
                $description = $tr->translate($request->input("description.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= strip_tags($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = strip_tags($tr->translate($init_description));
                }
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= strip_tags($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = strip_tags($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= strip_tags($tr->translate($item));
                    }

                    $description = $result;

                } else {
                    $description = strip_tags($tr->translate($init_description));
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
            $description = strip_tags($request->description[$language]);
            $init_description = strip_tags($request->input("description.1"));
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
            ////title
            if (!isset($title) && isset($description)) {
                $title = $tr->translate($request->input("title.1"));
                $description = $tr->translate($request->input("description.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= strip_tags($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = strip_tags($tr->translate($init_description));
                }
            } else if ($title != null && $description == null) {
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= strip_tags($tr->translate($item));
                    }
                    $description = $result;

                } else {
                    $description = strip_tags($tr->translate($init_description));
                }
            } else if ($title == null && $description == null) {
                $title = $tr->translate($request->input("title.1"));
                if (is_array($init_description)) {

                    foreach ($init_description as $key => $item) {
                        $result .= strip_tags($tr->translate($item));
                    }

                    $description = $result;

                } else {
                    $description = strip_tags($tr->translate($init_description));
                }

            }
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $language;
            $translation->future_list_id = $future_list;


            $translation->save();

        }
    }
}

?>
