<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\InnovationServiceItem;
use App\Models\Language;
use App\Models\ServiceCard;
use App\Models\Setting;
use App\Models\Social;
use App\Models\Study;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Carbon::setLocale(app()->getLocale());
        Paginator::useBootstrap();
        $languages = Language::where('status',1)->get();
        $settings = Setting::first();
        $socials = Social::all();
        $authed_user =Auth::user();

        $_clients =  Client::all();
        View::share('languages',$languages);
        View::share('settings',$settings);
        View::share('socials',$socials);
        View::share('authed_user',$authed_user);
        View::share('_clients',$_clients);
        Fortify::loginView('auth.login');
    }
}
