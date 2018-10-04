<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as MaintenanceMode;

class CheckForMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle($request, Closure $next)
    {
        if ($this->app->isDownForMaintenance() &&
            !in_array($request->getClientIp(), explode(',', env('CHECK_MAINTENANCE_MODE_IPS'))))
        {

            $maintenanceMode = new MaintenanceMode($this->app);
            return $maintenanceMode->handle($request, $next);
        }

        return $next($request);
    }
}
