<?php

namespace App\Providers;

use App\Services\CabinetPolicyService;
use Illuminate\Support\ServiceProvider;

class CabinetPolicyServiceProvider extends ServiceProvider
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
        $this->app->singleton('cabinetPolicyService', function () {
            return new CabinetPolicyService(\Config::get('cabinet'));
        });
    }
}
