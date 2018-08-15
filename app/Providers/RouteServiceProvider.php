<?php

namespace App\Providers;

use App\City;
use App\Doctor;
use App\Medcenter;
use App\Skill;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();

        Route::bind('city', function ($value) {
            return City::where('alias', $value)->first() ?? abort(404);
        });

        Route::bind('skill', function ($value) {
            return Skill::where('alias', $value)->first() ?? abort(404);
        });

        Route::bind('doctor', function ($value) {
            return Doctor::where('alias', $value)->where('status', 1)->first() ?? abort(404);
        });

        Route::bind('medcenter', function ($value) {
            return Medcenter::where('alias', $value)->where('status', 1)->first() ?? abort(404);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapSandboxRoutes();
        $this->mapUserRoutes();
        $this->mapSeoRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::domain(env('APP_URL_SHORT'))
            ->middleware(['web', 'city'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));

        Route::name('admin.')
            ->domain('admin.' . env('APP_URL_SHORT'))
            ->middleware(['web', 'city', 'role:superuser'])
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }


    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('web') // TODO: but must be API
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapSandboxRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/sandbox.php'));
    }

    protected function mapUserCabinetRoutes()
    {
        Route::prefix('cabinet')
            ->middleware('cabinet')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapSeoRoutes()
    {
        Route::prefix('seo')
            ->name('seo.')
            ->namespace($this->namespace)
            ->middleware(['web', 'role:seo'])
            ->group(base_path('routes/seo.php'));
    }


    protected function mapUserRoutes()
    {
        Route::prefix('user')
            ->name('user.')
            ->middleware(['web', 'phone_verified', 'city'])
            ->namespace($this->namespace)
            ->group(base_path('routes/auth/user.php'));
    }

}
