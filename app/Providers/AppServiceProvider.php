<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
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
        $languages = \Illuminate\Support\Facades\DB::table('languages')->where('status',1)->get();
        $settings = \Illuminate\Support\Facades\DB::table('settings')->first();
        $socials = \Illuminate\Support\Facades\DB::table('socials');
        View::share('languages',$languages);
        View::share('settings',$settings);
        View::share('socials',$socials);
        Fortify::loginView('auth.login');
    }
}
