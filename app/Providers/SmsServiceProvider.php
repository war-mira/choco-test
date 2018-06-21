<?php

namespace App\Providers;

use App\Services\EmailService;
use App\Services\SmsService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('smsService', function ($app) {

            if (App::environment('local')) {
                $smsService = new EmailService();
            } else {
                $smsService = new SmsService($app['config']['sms']);
            }
            return $smsService;
        });
    }
}
