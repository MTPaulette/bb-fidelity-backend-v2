<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;

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
        //$this->registerPolicies();
     
        ResetPassword::createUrlUsing(function ($user, string $token) {
            return 'http://127.0.0.1:3000/reset-password?token='.$token;
        });
    }
}
