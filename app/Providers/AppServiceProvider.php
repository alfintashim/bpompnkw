<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(199);

        // config(['app.locale' => 'id']);

        // Carbon::setLocale('id');
        \Carbon\Carbon::setLocale('id');
        \Carbon\Carbon::setLocale(config('app.locale'));
        date_default_timezone_set('Asia/Jakarta');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 
    }
}
