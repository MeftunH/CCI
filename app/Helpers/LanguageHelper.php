<?php
namespace App\Helpers;

use App\Models\AboutUsTranslation;
use App\Models\AcademyCardTranslation;
use App\Models\AcademyCareerItemTranslation;
use App\Models\AcademyCareerTranslation;
use App\Models\AcademyTranslation;
use App\Models\ApplyIntroTranslation;
use App\Models\CareerConsultingCardTranslation;
use App\Models\CareerConsultingItemTranslation;
use App\Models\CareerConsultingTranslation;
use App\Models\CareerTranslation;
use App\Models\CaseStudyTranslations;
use App\Models\ConnectIntro;
use App\Models\ConnectIntroTranslation;
use App\Models\EventIntroTranslation;
use App\Models\EventTranslation;
use App\Models\FutureItemTranslation;
use App\Models\FutureListTranslation;
use App\Models\FutureTranslation;
use App\Models\HomeInnovationModuleTranslation;
use App\Models\HomeIntroTranslation;
use App\Models\HomeUnlockModuleTranslation;
use App\Models\IndustryClientItemTranslation;
use App\Models\IndustryClientTranslation;
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
use App\Models\ReachModuleTranslation;
use App\Models\ServiceCardTranslation;
use App\Models\ServiceTranslation;
use App\Models\StudyTranslation;
use App\Models\TechnologyCard;
use App\Models\TechnologyCardTranslation;
use App\Models\TimeLineTranslation;
use App\Models\UploadResumeTranslation;
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
    public static function DateTranslateWithDay($date)
    {
        $translatedDate=Carbon::parse($date)->translatedFormat('F d Y');
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

    public function translate_and_save_resume_intro($code,$language_first,$new_lang)
    {
      $resume = UploadResumeTranslation::where('language_id',$language_first->id)->get();
        foreach ($resume as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);

            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);
            $footer = $tr->translate($item->footer);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->footer = $footer;
            $translation->language_id = $new_lang->id;
            $translation->save();
        }
    }
    public function industry_translate_and_save($code,$language_first,$new_lang)
    {
        $model = new IndustryTranslation();
        $this->translate_and_save($code,$language_first,$new_lang,$model);
    }


    public function news_intro_translate_and_save($code,$language_first,$new_lang)
    {
        $model = new NewsIntroTranslation();
        $this->translate_and_save($code,$language_first,$new_lang,$model);
    }
    public function homepage_intro_translate_and_save($code,$language_first,$new_lang)
    {
        $model = new HomeIntroTranslation();
        $this->translate_and_save($code,$language_first,$new_lang,$model);
    }
    public function events_intro_translate_and_save($code,$language_first,$new_lang): void
    {
        $model = new EventIntroTranslation();
        $this->translate_and_save($code,$language_first,$new_lang,$model);
    }
    public function connect_intro_translate_and_save($code,$language_first,$new_lang): void
    {
        $model = new ConnectIntroTranslation();
        $this->translate_and_save($code,$language_first,$new_lang,$model);
    }

    public function partner_intro_translate_and_save($code,$language_first,$new_lang): void
    {
        $model = new PartnerIntroTranslation();
        $this->translate_and_save($code,$language_first,$new_lang,$model);
    }
    public function apply_intro_translate_and_save($code,$language_first,$new_lang): void
    {
        $model = new ApplyIntroTranslation();
        $this->translate_and_save($code,$language_first,$new_lang,$model);
    }
    public function unlock_translate_and_save($code,$language_first,$new_lang): void
    {
        $query = HomeUnlockModuleTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by__field_unlock($code,$new_lang,$query);
    }
    public function innovation_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = InnovationServiceTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field($code,$new_lang,$query);
    }
    public function industry_client_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = IndustryClientTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_industry_client($code,$new_lang,$query);
    }
    public function innovation_module_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = HomeInnovationModuleTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_innovation_module($code,$new_lang,$query);
    }
    public function tc_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = TechnologyCardTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_field_tc($code,$new_lang,$query);
    }


    public function service_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = ServiceTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_service($code,$new_lang,$query);
    }
    public function academy_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = AcademyTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_academy($code,$new_lang,$query);
    }

    public function career_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = CareerTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_career($code,$new_lang,$query);
    }

    public function academy_career_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = AcademyCareerTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_academy_career($code,$new_lang,$query);
    }
    public function academy_career_item_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = AcademyCareerItemTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_academy_career_item($code,$new_lang,$query);
    }
    public function career_consulting_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = CareerConsultingTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_career_consulting($code,$new_lang,$query);
    }
    public function career_consulting_item_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = CareerConsultingItemTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_career_consulting_item($code,$new_lang,$query);
    }
    public function career_consulting_card_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = CareerConsultingCardTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_career_consulting_card($code,$new_lang,$query);
    }
    public function case_study_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = CaseStudyTranslations::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by__field_case_study($code,$new_lang,$query);
    }
    public function study_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = StudyTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_study($code,$new_lang,$query);
    }
    public function operational_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = OperationalTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_field_operational($code,$new_lang,$query);
    }
    public function academy_card_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = AcademyCardTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_field_academy_card($code,$new_lang,$query);
    }
    public function news_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = NewsTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_career_news($code,$new_lang,$query);
    }
    public function innovation_item_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = InnovationServiceItemTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_industry_innovation_item($code,$new_lang,$query);
    }
    public function events_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = EventTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_events($code,$new_lang,$query);
    }
    public function industry_experience_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = IndustryExperienceTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_industry_experience($code,$new_lang,$query);
    }
    public function service_card_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = ServiceCardTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_service_card($code,$new_lang,$query);
    }
    public function future_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = FutureTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_future($code,$new_lang,$query);
    }
    public function future_list_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = FutureListTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_future_list($code,$new_lang,$query);
    }
    public function future_item_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = FutureItemTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_casual_field_future_item($code,$new_lang,$query);
    }
    public function industry_client_item_translate_and_save($code,$language_first,$new_lang): void
    {

        $query = IndustryClientItemTranslation::where('language_id',$language_first->id)->get();
        $this->translate_and_save_by_field_industry_client_item($code,$new_lang,$query);
    }
    private function translate_and_save($code,$language_first,$new_lang,Model $model): void
    {
        $data = $model::where('language_id',$language_first->id)->get();
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->innovation_id = $item->innovation_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_innovation_module($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->intro_id = $item->intro_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_field_tc($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->card_id = $item->card_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_industry_client($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->industry_client_id = $item->industry_client_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_industry_innovation_item($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->language_id = $new_lang->id;
            $translation->item_id = $item->item_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_study($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->study_id = $item->study_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_future_item($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->language_id = $new_lang->id;
            $translation->future_item_id = $item->future_item_id;
            $translation->save();
        }
    }

    private function translate_and_save_by_casual_field_academy_career_item($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->language_id = $new_lang->id;
            $translation->item_id = $item->item_id;
            $translation->save();
        }
    }

    private function translate_and_save_by_casual_field_career_consulting_item($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->language_id = $new_lang->id;
            $translation->item_id = $item->item_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_service($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->service_id = $item->service_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_future_list($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->future_list_id = $item->future_list_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_academy($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->academy_id = $item->academy_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_academy_career($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->ac_id = $item->ac_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_career_consulting($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->cc_id = $item->cc_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_career_consulting_card($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->cc_card_id = $item->cc_card_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_career_news($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->news_id = $item->news_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_events($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->event_id = $item->event_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_service_card($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->service_card_id = $item->service_card_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_future($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->future_id = $item->future_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_industry_experience($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->experience_id = $item->experience_id;
            $translation->save();
        }
    }
    private function translate_and_save_by__field_case_study($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);

            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);
            $footer = $tr->translate($item->footer);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->footer = $footer;
            $translation->language_id = $new_lang->id;
            $translation->cs_id = $item->cs_id;
            $translation->save();
        }
    }
    private function translate_and_save_by__field_unlock($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);

            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);
            $footer = $tr->translate($item->footer);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->footer = $footer;
            $translation->language_id = $new_lang->id;
            $translation->intro_id = $item->intro_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_casual_field_career($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->career_id = $item->career_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_field_operational($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->operational_id = $item->operational_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_field_academy_card($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);

            $title = $tr->translate($item->title);
            $description = $tr->translate($item->description);

            $translation = $item->replicate();
            $translation->title = $title;
            $translation->description = $description;
            $translation->language_id = $new_lang->id;
            $translation->academy_card_id = $item->academy_card_id;
            $translation->save();
        }
    }
    private function translate_and_save_by_field_industry_client_item($code,$new_lang,$query): void
    {
        $data = $query;
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $title = $tr->translate($item->title);
            $translation = $item->replicate();
            $translation->title = $title;
            $translation->language_id = $new_lang->id;
            $translation->item_id = $item->item_id;
            $translation->save();
        }
    }
    public function reach_module_translate_and_save($code,$language_first,$new_lang): void
    {
        $data = ReachModuleTranslation::where('language_id',$language_first->id)->get();
        foreach ($data as $item) {
            $tr = new GoogleTranslate();
            $tr->setSource();
            $tr->setTarget($code);
            $tr->setUrl('http://translate.google.cn/translate_a/t');
            $address = $tr->translate($item->address);
            $working_hours = $tr->translate($item->working_hours);

            $translation = $item->replicate();
            $translation->address = $address;
            $translation->working_hours = $working_hours;
            $translation->language_id = $new_lang->id;
            $translation->module_id = $item->module_id;
            $translation->save();
        }
    }
}

?>
