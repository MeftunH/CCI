<?php
namespace App\Helpers;

use App\Models\AboutUsTranslation;
use App\Models\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;

class SiteHelper{
    public static function test()
    {
        echo 'HELLO';
    }

    public function translate_and_save($request,$id)
    {
        foreach ($request->title as $language => $title) {
            $translation = AboutUsTranslation::where('aboutUs_id', $id)->where('language_id', $language)->first();
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
}
?>
