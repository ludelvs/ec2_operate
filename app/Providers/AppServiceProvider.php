<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $is_ssl = strpos(env('APP_URL'), 'https') !== false ? true : false;
        \View::share('is_ssl', $is_ssl);

   //     if (env('APP_ENV') != 'local') \URL::forceScheme('https');
    }
}
