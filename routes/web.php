<?php

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

Route::get('/', function () {return view('pages.index');})->name('index');
Route::get('/about', function () {return view('pages.about');})->name('about');
Route::get('/careers', function () {return view('pages.careers');})->name('careers');
Route::get('/news', function () {return view('pages.news');})->name('news');
Route::get('/events', function () {return view('pages.events');})->name('events');
Route::get('/connect', function () {return view('pages.connect');})->name('connect');
Route::get('/partners', function () {return view('pages.partners');})->name('partners');

