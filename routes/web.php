<?php


use App\Http\Controllers\Backend\AboutUsController;
use App\Http\Controllers\Backend\CaseStudyController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\FutureController;
use App\Http\Controllers\Backend\OperationalController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\FrontCaseStudyController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

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
    'middleware' => ['localeSessionRedirect', 'localizationRedirect',]], function () {
    Route::get('/home', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::resource('languages', LanguageController::class);
    Route::resource('aboutUs', AboutUsController::class);
    Route::resource('caseStudies', CaseStudyController::class);
    Route::resource('clients',ClientController::class);

    Route::name('aboutUs.')->group(function () {

        Route::resource('operational', OperationalController::class);
        Route::resource('future', FutureController::class);

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


    });
    Route::get('/', function () {
        return view('pages.index');
    })->name('index');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/caseStudy', [FrontCaseStudyController::class, 'index'])->name('case_studies');
    Route::get('/academy', function () {
        return view('pages.academy');
    })->name('academy');
    Route::get('/industries', function () {
        return view('pages.industries');
    })->name('industries');
    Route::get('/services', function () {
        return view('pages.services');
    })->name('services');
    Route::get('/careers', function () {
        return view('pages.careers');
    })->name('careers');
    Route::get('/events', function () {
        return view('pages.events');
    })->name('events');
    Route::get('/connect', function () {
        return view('pages.connect');
    })->name('connect');
    Route::get('/partners', function () {
        return view('pages.partners');
    })->name('partners');
    Route::get('/news', function () {
        return view('pages.news');
    })->name('news');
});
Route::get('pages/config/edittranslation{edit?}', [LanguageController::class, 'EditTranslation'])->name('translation.edit');
Route::post('/save/translation', [LanguageController::class, 'SaveTranslation'])->name('translation.save');

