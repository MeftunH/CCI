<?php
namespace App\Helpers;

use App\Models\AboutUsTranslation;
use App\Models\Language;
use App\Models\LongTermItemTranslation;
use App\Models\LongTermTranslation;
use App\Models\TimeLineTranslation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Stichoza\GoogleTranslate\GoogleTranslate;

class LanguageHelper
{
    public static function DateTranslate($date)
    {
        $translatedDate=Carbon::parse($date)->translatedFormat('F Y');
        return $translatedDate;
    }
    public function translate_and_save_long_term($code, $language_first,$new_lang)
    {
        $tr = new GoogleTranslate();
        $tr->setSource();
        $tr->setTarget($code);
        $about_us_long_term =  LongTermTranslation::where('language_id', $language_first->id)->first();
        $title = $tr->translate($about_us_long_term->title);
        $init_description = $about_us_long_term->descipriton;
        $result = "";
        if (strlen($about_us_long_term->descipriton) > 2999) {
            $init_description = str_split($about_us_long_term->descipriton, 2999);
            if (is_array($init_description)) {
                foreach ($init_description as $key => $val) {
                    $result .= strip_tags($tr->translate($val));
                }
                $description = $result;

            } else {
                $description = $tr->translate($init_description);

            }
        } else {
            $description = $tr->translate($about_us_long_term->description);

        }

        $translation = $about_us_long_term->replicate();
        $translation->title = $title;
        $translation->description = $description;
        $translation->language_id = $new_lang->id;
        $translation->save();
    }

    public function translate_and_save_long_term_items($code, $language_first,$new_lang)
    {
        $about_us_long_term_items =  LongTermItemTranslation::where('language_id', $language_first->id)->get();
        foreach ($about_us_long_term_items as $item) {
        $tr = new GoogleTranslate();
        $tr->setSource();
        $tr->setTarget($code);

        $title = $tr->translate($item->title);

        $translation = $item->replicate();
        $translation->title = $title;
        $translation->language_id = $new_lang->id;
        $translation->save();
        }
    }

    public function translate_and_save_time_line($code, $language_first,$new_lang)
    {
        $time_line =  TimeLineTranslation::where('language_id', $language_first->id)->get();
        foreach ($time_line as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);

            $title = $tr->translate($item->title);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->language_id = $new_lang->id;
            $translation->save();
        }
    }
}

?>
