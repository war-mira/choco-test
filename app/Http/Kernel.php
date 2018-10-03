<?php

namespace App\Http;

use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckUserPhoneVerified;
use App\Http\Middleware\Http2Push;
use App\Http\Middleware\RedirectManager;
use App\Http\Middleware\SetDefaultCityForUrl;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        RedirectManager::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            Http2Push::class

        ],
        'api' => [
            'throttle:60,1',
            'bindings',
        ],

    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'           => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic'     => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'       => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can'            => \Illuminate\Auth\Middleware\Authorize::class,
        'doctor'           =>\App\Http\Middleware\DoctorCheck::class,
        'guest'          => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'       => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'role'           => CheckRole::class,
        'phone_verified' => CheckUserPhoneVerified::class,
        'city'           => SetDefaultCityForUrl::class
    ];
}
