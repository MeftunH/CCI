<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Mail\ResumeMail;
use App\Models\Career;
use App\Models\CareerConsulting;
use App\Models\CareerConsultingCard;
use App\Models\CareerConsultingItem;
use App\Models\Resume;
use App\Models\UploadResume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;

class FrontCareerController extends Controller
{

    public function index()
    {
        $career = Career::languages(app()->getLocale())->first();
        $career_consulting = CareerConsulting::languages(app()->getLocale())->first();
        $career_consulting_items = CareerConsultingItem::languages(app()->getLocale())->get();
        $cc_cards = CareerConsultingCard::languages(app()->getLocale());
        $resume_up = UploadResume::all()->first();
        $resume_up_translations = UploadResume::Lang()->first();

        return view('pages.careers.careers', compact('career', 'resume_up','resume_up_translations','cc_cards', 'career_consulting', 'career_consulting_items'));
    }

    public function read_more($id)
    {
        $cc_card = CareerConsultingCard::where('id', $id)->first();
        $translations = CareerConsultingCard::languages(app()->getLocale())->where('cc_card_id', $id)->where('status', 1)->first();

        return view('pages.careers.read_more', compact('cc_card', 'translations'));
    }

    public function upload_cv(Request $request)
    {
        $resume = new Resume();
        $validateData = $request->validate([
            'cv' => 'mimes:pdf,doc|max:8192|required',
        ]);

        if ($request->hasFile('cv')) {
            $completeFileName = $request->file('cv')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('cv')->getClientOriginalExtension();
            $file = str_replace(' ', '_', $fileNameOnly).'-'. rand() .'_'.time().'.'.$extension;
            $path = $request->file('cv')->storeAs('public/resumes', $file);
            $resume->resume = 'public/resumes/'.$file;
        }
        if($resume->save()){
            $resume_mail = new MailController();
            $resume_mail->sendEmail(Storage::url($resume->resume));
            echo 200;
        }else{
            echo 700;
        }
    }


}
