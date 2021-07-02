<?php


use App\Http\Controllers\Backend\AboutUsController;
use App\Http\Controllers\Backend\AcademyController;
use App\Http\Controllers\Backend\AjaxUploadMultipleImageController;
use App\Http\Controllers\Backend\ApplyController;
use App\Http\Controllers\Backend\CareerController;
use App\Http\Controllers\Backend\CaseStudyController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\ConnectController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\FutureController;
use App\Http\Controllers\Backend\IndustryController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\OperationalController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\ResumeController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SocialController;
use App\Http\Controllers\Backend\StudyController;
use App\Http\Controllers\Backend\SubscriberController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\FrontAcademyController;
use App\Http\Controllers\Frontend\FrontApplyController;
use App\Http\Controllers\Frontend\FrontCareerController;
use App\Http\Controllers\Frontend\FrontCaseStudyController;
use App\Http\Controllers\Frontend\FrontConnectController;
use App\Http\Controllers\Frontend\FrontendIndustryController;
use App\Http\Controllers\Frontend\FrontEventController;
use App\Http\Controllers\Frontend\FrontNewsController;
use App\Http\Controllers\Frontend\FrontPartnerController;
use App\Http\Controllers\Frontend\FrontServiceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::middleware(['auth', 'verified'])->group(function ()  {
        Route::view('/home', 'admin.index')->name('admin.index');
        Route::view('/profile','profile.profile')->name('profile');
    });
//    Route::middleware(['auth', 'verified'])->group(function () {
//        Route::view('/home', 'admin.index')->name('admin.index');
//
//
//    });
    Route::get('/send-email', [MailController::class, 'sendEmail']);
    Route::post('contact-us', [ContactController::class, 'saveContact']);
    Route::post('apply-mail', [ApplyController::class, 'saveApply']);
    Route::resource('languages', LanguageController::class);
    Route::resource('aboutUs', AboutUsController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('academy', AcademyController::class);
    Route::resource('career', CareerController::class);
    Route::resource('connects', ConnectController::class);
    Route::resource('applies', ApplyController::class);
    Route::resource('partner', PartnerController::class);
    Route::resource('caseStudies', CaseStudyController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('resumeUp', ResumeController::class);
    Route::resource('news', NewsController::class);
    Route::resource('events', EventController::class);
    Route::get('resume/{uuid}/download', [ResumeController::class, 'download'])->name('resume.download');
    Route::resource('studies', StudyController::class);
    Route::resource('social', SocialController::class);
    Route::resource('industry', IndustryController::class);
    Route::resource('service', ServiceController::class);
    Route::get('/allCaseStudies/', [FrontCaseStudyController::class, 'all_case_studies'])->name('caseStudies.all');
    Route::get('/read/{id}', [FrontCaseStudyController::class, 'read_more'])->name('caseStudies.read_more');
    Route::get('/readService/{id}', [FrontServiceController::class, 'read_more'])->name('services.read_more');
    Route::get('/readCareer/{id}', [FrontCareerController::class, 'read_more'])->name('career.read_more');
    Route::get('/readNews/{id}', [FrontNewsController::class, 'read_more'])->name('news.read_more');
    Route::get('/news-search/', [FrontNewsController::class, 'search'])->name('news.search');
    Route::get('/readEvent/{id}', [FrontEventController::class, 'read_more'])->name('events.read_more');
    Route::get('/academyDetails/{id}', [FrontAcademyController::class, 'read_more'])->name('academy.read_more');
    Route::get('/industryDetails/{id}', [FrontendIndustryController::class, 'read_more'])->name('industry.read_more');
    Route::post('/uploadCv', [FrontCareerController::class, 'upload_cv'])->name('career.upload_cv');
    Route::name('aboutUs.')->group(function () {

        Route::resource('operational', OperationalController::class);
        Route::resource('future', FutureController::class);

        Route::get('/addToSlider/', [ClientController::class, 'add_to_slider'])->name('caseStudies.clients.add_to_slider');
        Route::post('/updateSlider/', [ClientController::class, 'update_slider'])->name('caseStudies.clients.update_slider');
        Route::get('/longTerm', [AboutUsController::class, 'longTerm'])->name('long_term.index');
        Route::get('/longTerm/{longTerm}', [AboutUsController::class, 'longTermShow'])->name('long_term.show');
        Route::get('/longTerm/{longTerm}/edit', [AboutUsController::class, 'longTermEdit'])->name('long_term.edit');
        Route::post('/longTerm/{longTerm}', [AboutUsController::class, 'longTermUpdate'])->name('long_term.update');


        Route::get('/longTerm/item/create', [AboutUsController::class, 'longTermItemCreate'])->name('long_term.item.create');
        Route::get('/longTerm/item/{longTerm}', [AboutUsController::class, 'longTermItemShow'])->name('long_term.item.show');
        Route::post('/longTerm/item/create', [AboutUsController::class, 'longTermItemSave'])->name('long_term.item.save');
        Route::get('/longTerm/item/{longTerm}/edit', [AboutUsController::class, 'longTermItemEdit'])->name('long_term.item.edit');
        Route::post('/longTerm/item/{longTerm}', [AboutUsController::class, 'longTermItemUpdate'])->name('long_term.item.update');
        Route::delete('/item/{longTerm}', [AboutUsController::class, 'longTermItemDestroy'])->name('long_term.item.destroy');

        Route::get('/futureItem/item/create', [FutureController::class, 'futureItemCreate'])->name('future.item.create');
        Route::get('/futureItem/item/{item}', [FutureController::class, 'futureItemShow'])->name('future.item.show');
        Route::post('/futureItem/item/create', [FutureController::class, 'futureItemSave'])->name('future.item.save');
        Route::get('/futureItem/item/{future}/edit', [FutureController::class, 'futureItemEdit'])->name('future.item.edit');
        Route::post('/futureItem/item/{future}', [FutureController::class, 'futureItemUpdate'])->name('future.item.update');
        Route::delete('/futureItem/{future}', [FutureController::class, 'futureItemDestroy'])->name('future.item.destroy');

        Route::get('/futureListItem/item/create', [FutureController::class, 'futureListItemCreate'])->name('future.list.item.create');
        Route::post('/futureListItem/item/create', [FutureController::class, 'futureListItemSave'])->name('future.list.item.save');
        Route::get('/futureListItem/item/{item}', [FutureController::class, 'futureListItemShow'])->name('future.list.item.show');
        Route::get('/futureListItem/item/{futureListItem}/edit', [FutureController::class, 'futureListItemEdit'])->name('future.list.item.edit');
        Route::post('/futureListItem/item/{futureListItem}', [FutureController::class, 'futureListItemUpdate'])->name('future.list.item.update');
        Route::delete('/futureItem/{future}', [FutureController::class, 'futureListItemDestroy'])->name('future.item.destroy');

        Route::get('/timeLine/create', [AboutUsController::class, 'timeLineCreate'])->name('time_line.create');
        Route::post('/timeLine/create', [AboutUsController::class, 'timeLineSave'])->name('long_term.timeline.save');
        Route::get('/timeLine/{timeLine}/edit', [AboutUsController::class, 'timeLineEdit'])->name('long_term.timeline.edit');
        Route::post('/timeLine/{timeLine}', [AboutUsController::class, 'timeLineUpdate'])->name('long_term.timeline.update');
        Route::get('/timeLine/{timeLine}', [AboutUsController::class, 'timeLineShow'])->name('long_term.timeline.show');
        Route::delete('/timeLine/{timeLine}', [AboutUsController::class, 'timeLineDestroy'])->name('long_term.timeline.destroy');

        Route::get('/academyCareer/', [AcademyController::class, 'academyCareer'])->name('academyCareer.index');
        Route::get('/academyCareer/{academyCareer}/edit', [AcademyController::class, 'academyCareerEdit'])->name('academyCareer.edit');
        Route::post('/academyCareer/{academyCareer}', [AcademyController::class, 'academyCareerUpdate'])->name('academyCareer.update');
        Route::get('/academyCareer/{academyCareer}', [AcademyController::class, 'academyCareerShow'])->name('academyCareer.show');

        Route::get('/academyCareer/item/create', [AcademyController::class, 'academyCareerItemCreate'])->name('academy.career.item.create');
        Route::post('/academyCareer/item/create', [AcademyController::class, 'academyCareerItemSave'])->name('academy.career.item.save');
        Route::get('/academyCareer/item/{item}', [AcademyController::class, 'academyCareerItemShow'])->name('academy.career.item.show');
        Route::get('/academyCareer/item/{academyCareer}/edit', [AcademyController::class, 'academyCareerItemEdit'])->name('academy.career.item.edit');
        Route::post('/academyCareer/item/{academyCareer}', [AcademyController::class, 'academyCareerItemUpdate'])->name('academy.career.item.update');
        Route::delete('/academyCareer/{academyCareer}', [AcademyController::class, 'academyCareerItemDestroy'])->name('academy.career.item.destroy');

        Route::get('/academyCard/create', [AcademyController::class, 'academyCardCreate'])->name('academy.card.create');
        Route::post('/academyCard/create', [AcademyController::class, 'academyCardSave'])->name('academy.card.save');
        Route::get('/academyCard/card/{item}', [AcademyController::class, 'academyCardShow'])->name('academy.card.show');
        Route::get('/academyCard/{academyCard}/edit', [AcademyController::class, 'academyCardEdit'])->name('academy.card.edit');
        Route::post('/academyCard/{academyCard}/edit', [AcademyController::class, 'academyCardUpdate'])->name('academy.card.update');
        Route::delete('/academyCard/{academyCard}', [AcademyController::class, 'academyCardDestroy'])->name('academy.card.destroy');

        Route::get('/industryClient/', [IndustryController::class, 'industryClient'])->name('industry.client.index');
        Route::get('/industryClient/{industryClient}', [IndustryController::class, 'industryClientShow'])->name('industry.client.show');
        Route::get('/industryClient/{industryClient}/edit', [IndustryController::class, 'industryClientEdit'])->name('industry.client.edit');
        Route::post('/industryClient/{industryClient}/edit', [IndustryController::class, 'industryClientUpdate'])->name('industry.client.update');

        Route::get('/industryClient/item/create', [IndustryController::class, 'industryClientItemCreate'])->name('industry.client.item.create');
        Route::post('/industryClient/item/create', [IndustryController::class, 'industryClientSave'])->name('industry.client.item.save');
        Route::get('/industryClient/item/{item}', [IndustryController::class, 'industryClientItemShow'])->name('industry.client.item.show');
        Route::get('/industryClient/item/{industryClient}/edit', [IndustryController::class, 'industryClientItemEdit'])->name('industry.client.item.edit');
        Route::post('/industryClient/item/{industryClient}', [IndustryController::class, 'industryClientItemUpdate'])->name('industry.client.item.update');
        Route::delete('/industryClient/{industryClient}', [IndustryController::class, 'industryClientItemDestroy'])->name('industry.client.item.destroy');

        Route::get('/experience/create', [IndustryController::class, 'experienceCreate'])->name('industry.experience.create');
        Route::post('/experience/create', [IndustryController::class, 'experienceSave'])->name('industry.experience.save');
        Route::get('/experience/card/{experience}', [IndustryController::class, 'experienceShow'])->name('industry.experience.show');
        Route::get('/experience/{experience}/edit', [IndustryController::class, 'experienceEdit'])->name('industry.experience.edit');
        Route::post('/experience/{experience}/edit', [IndustryController::class, 'experienceUpdate'])->name('industry.experience.update');
        Route::delete('/experience/{experience}', [IndustryController::class, 'experienceDestroy'])->name('industry.experience.destroy');

        Route::get('/innovation/', [ServiceController::class, 'innovation'])->name('services.innovation.index');
        Route::get('/services/innovation/{inno}/edit', [ServiceController::class, 'innovationEdit'])->name('services.innovation.edit');
        Route::get('/services/innovation/{inno}/show', [ServiceController::class, 'innovationShow'])->name('services.innovation.show');
        Route::post('/services/innovation/{inno}/edit', [ServiceController::class, 'innovationUpdate'])->name('services.innovation.update');

        Route::get('/innovation/item/create', [ServiceController::class, 'innovationItemCreate'])->name('services.innovation.item.create');
        Route::post('/innovation/item/create', [ServiceController::class, 'innovationItemSave'])->name('services.innovation.item.save');
        Route::get('/innovation/{item}/show', [ServiceController::class, 'innovationItemShow'])->name('services.innovation.item.show');
        Route::get('/innovation/{item}/edit', [ServiceController::class, 'innovationItemEdit'])->name('services.innovation.item.edit');
        Route::post('/innovation/{item}/edit', [ServiceController::class, 'innovationItemUpdate'])->name('services.innovation.item.update');
        Route::delete('/innovation/{item}/destroy', [ServiceController::class, 'innovationItemDestroy'])->name('services.innovation.item.destroy');

        Route::get('/service/card/create', [ServiceController::class, 'serviceCardCreate'])->name('services.card.create');
        Route::post('/service/card/create', [ServiceController::class, 'serviceCardSave'])->name('services.card.save');
        Route::get('/service/{card}/card/edit', [ServiceController::class, 'serviceCardEdit'])->name('services.card.edit');
        Route::get('/service/{card}/card/show', [ServiceController::class, 'serviceCardShow'])->name('services.card.show');
        Route::post('/service/{card}/card/edit', [ServiceController::class, 'serviceCardUpdate'])->name('services.card.update');
        Route::delete('/service/{card}/destroy', [ServiceController::class, 'serviceCardDestroy'])->name('services.card.destroy');
        Route::get('news/get-news/', [NewsController::class, "getNews"])->name('news.getNews');


    });
    Route::name('partner.')->group(function () {
        Route::get('/partners/partner/create', [PartnerController::class, 'partnerItemCreate'])->name('item.create');
        Route::post('/partners/partner/create', [PartnerController::class, 'partnerItemSave'])->name('item.save');
        Route::get('/partners/{partner}/item/edit', [PartnerController::class, 'partnerItemEdit'])->name('item.edit');
        Route::get('/partners/{partner}/item/show', [PartnerController::class, 'partnerItemShow'])->name('item.show');
        Route::post('/partners/{partner}/item/edit', [PartnerController::class, 'partnerItemUpdate'])->name('item.update');
        Route::delete('/partners/{partner}/destroy', [PartnerController::class, 'partnerItemDestroy'])->name('item.destroy');
    });
    Route::name('news.')->group(function () {
        Route::get('slider/news/create', [NewsController::class, 'newsCreate'])->name('newsCreate');
        Route::post('slider/news/create', [NewsController::class, 'newsSave'])->name('newsSave');
        Route::get('slider/news/edit/{id}', [NewsController::class, 'newsEdit'])->name('newsEdit');
        Route::get('slider/news/show/{id}', [NewsController::class, 'newsShow'])->name('newsShow');
        Route::post('slider/news/edit/{id}', [NewsController::class, 'newsUpdate'])->name('newsUpdate');
        Route::delete('slider/news/delete/{id}', [NewsController::class, 'newsDestroy'])->name('newsDestroy');

    });
    Route::name('events.')->group(function () {
        Route::get('slider/events/create', [EventController::class, 'eventCreate'])->name('eventCreate');
        Route::post('slider/events/create', [EventController::class, 'eventSave'])->name('eventSave');
        Route::get('slider/events/edit/{id}', [EventController::class, 'eventEdit'])->name('eventEdit');
        Route::get('slider/events/show/{id}', [EventController::class, 'eventShow'])->name('eventShow');
        Route::post('slider/events/edit/{id}', [EventController::class, 'eventUpdate'])->name('eventUpdate');
        Route::delete('slider/events/delete/{id}', [EventController::class, 'eventDestroy'])->name('eventDestroy');
    });
    Route::name('careerConsulting.')->group(function () {
        Route::get('/careerConsulting/', [CareerController::class, 'careerConsulting'])->name('index');
        Route::get('/careerConsulting/{careerConsulting}/edit', [CareerController::class, 'careerConsultingEdit'])->name('edit');
        Route::post('/careerConsulting/{careerConsulting}', [CareerController::class, 'careerConsultingUpdate'])->name('update');
        Route::get('/careerConsulting/{careerConsulting}', [CareerController::class, 'careerConsultingShow'])->name('show');
    });
    Route::name('careerConsultingItem.')->group(function () {
        Route::get('/careerConsultingItem/create', [CareerController::class, 'careerConsultingItemCreate'])->name('item.create');
        Route::post('/careerConsultingItem/create', [CareerController::class, 'careerConsultingItemSave'])->name('item.save');
        Route::get('/careerConsultingItem/{item}/edit', [CareerController::class, 'careerConsultingItemEdit'])->name('item.edit');
        Route::post('/careerConsultingItem/{item}', [CareerController::class, 'careerConsultingItemUpdate'])->name('item.update');
        Route::get('/careerConsultingItem/{item}', [CareerController::class, 'careerConsultingItemShow'])->name('item.show');
        Route::delete('/careerConsultingItem/{item}/destroy', [CareerController::class, 'careerConsultingItemDestroy'])->name('item.destroy');
    });

    Route::name('careerConsultingCard.')->group(function () {
        Route::get('/careerConsultingCard/create', [CareerController::class, 'careerConsultingCardCreate'])->name('card.create');
        Route::post('/careerConsultingCard/create', [CareerController::class, 'careerConsultingCardSave'])->name('card.save');
        Route::get('/careerConsultingCard/{card}/edit', [CareerController::class, 'careerConsultingCardEdit'])->name('card.edit');
        Route::get('/careerConsultingCard/{card}/show', [CareerController::class, 'careerConsultingCardShow'])->name('card.show');
        Route::post('/careerConsultingCard/{card}/edit', [CareerController::class, 'careerConsultingCardUpdate'])->name('card.update');
        Route::get('/careerConsultingCard/{card}', [CareerController::class, 'careerConsultingCardShow'])->name('card.show');
        Route::delete('/careerConsultingCard/{card}/destroy', [CareerController::class, 'careerConsultingCardDestroy'])->name('card.destroy');
    });
    Route::name('reach.')->group(function () {
        Route::get('/reach-module/{module}/edit', [ConnectController::class, 'reachEdit'])->name('edit');
        Route::post('/reach-module/{module}/edit', [ConnectController::class, 'reachUpdate'])->name('update');
        Route::get('/reach-module/{module}/show', [ConnectController::class, 'reachShow'])->name('show');

    });
    Route::name('subscriber.')->group(function () {
        Route::get('/subs/index', [SubscriberController::class, 'index'])->name('index');
        Route::post('/subscribe', [SubscriberController::class, 'store'])->name('store');
        Route::get('/unsubscribe', [SubscriberController::class, 'destroy'])->name('destroy');

    });
    Route::get('/', function () {
        return view('pages.index');
    })->name('index');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/caseStudy', [FrontCaseStudyController::class, 'index'])->name('case_studies');
    Route::get('/academyAndCareer', [FrontAcademyController::class, 'index'])->name('academy');
    Route::get('/industries', [FrontendIndustryController::class, 'index'])->name('industries');
    Route::get('/services', [FrontServiceController::class, 'index'])->name('services');
    Route::get('/careers', [FrontCareerController::class, 'index'])->name('careers');
    Route::get('/event', [FrontEventController::class, 'index'])->name('event');
    Route::get('/connect', [FrontConnectController::class, 'index'])->name('connect');
    Route::get('/apply', [FrontApplyController::class, 'index'])->name('apply');
    Route::get('/partners', [FrontPartnerController::class, 'index'])->name('partners');
    Route::get('/latest-news', [FrontNewsController::class, 'index'])->name('news');
});
Route::get('pages/config/edittranslation{edit?}', [LanguageController::class, 'EditTranslation'])->name('translation.edit');
Route::post('/save/translation', [LanguageController::class, 'SaveTranslation'])->name('translation.save');
//Route::get('/resume/send',[EmailController::class, 'sendEmailResume'])->name('email.resume.send');
//Route::get('sendattachmentemail', [MailController::class, 'resume_email']);

Route::post('upload-multiple-image-ajax', [AjaxUploadMultipleImageController::class, 'saveUpload']);
