<?php


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
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
Route::get('/home',function ()
{
    return view('admin.index');
})->name('admin.index');

    Route::resource('languages', LanguageController::class)->names([
        'create' => 'language.create'
    ]);

Route::get('/', function () {return view('pages.index');})->name('index');
Route::get('/about', function () {return view('pages.about');})->name('about');
Route::get('/caseStudies', function () {return view('pages.caseStudies');})->name('case_studies');
Route::get('/academy', function () {return view('pages.academy');})->name('academy');
Route::get('/industries', function () {return view('pages.industries');})->name('industries');
Route::get('/services', function () {return view('pages.services');})->name('services');
Route::get('/careers', function () {return view('pages.careers');})->name('careers');
Route::get('/events', function () {return view('pages.events');})->name('events');
Route::get('/connect', function () {return view('pages.connect');})->name('connect');
Route::get('/partners', function () {return view('pages.partners');})->name('partners');
Route::get('/news', function () {return view('pages.news');})->name('news');
});

