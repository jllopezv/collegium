<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //date_default_timezone_set('America/Santo_Domingo');
        Carbon::setLocale('es');

        Blade::if('isSuperadmin', function () {
            return Auth::check() && Auth::user()->isSuperadmin();
        });

        Blade::if('isAdmin', function () {
            return Auth::check() && Auth::user()->isAdmin();
        });

        Blade::if('hasAbility', function ($slug) {
            return Auth::check() && Auth::user()->hasAbility($slug);
        });

        Blade::if('hasAbilityOr', function ($slug) {
            return Auth::check() && Auth::user()->hasAbilityOr($slug);
        });
    }
}
