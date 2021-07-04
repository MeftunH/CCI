<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\Setting;
use App\Models\Social;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

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
        Collection::macro('sortAsc', function () {
            $this->sort(function($a, $b)  {
                if ($a == $b) {
                    return ($a > $b) ? -1 : 1;

                }
                return 0;
            });
        });
        Paginator::useBootstrap();
        $languages = Language::where('status',1)->get();
        $settings = Setting::first();
        $socials = Social::all();
        $authed_user =Auth::user();
        View::share('languages',$languages);
        View::share('settings',$settings);
        View::share('socials',$socials);
        View::share('authed_user',$authed_user);
        Fortify::loginView('auth.login');
    }
}
