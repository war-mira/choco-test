<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as MaintenanceMode;
use Illuminate\Support\Facades\Redis;

class CheckForMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $except =
        [
            'allow-ip*',
        ];

    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle($request, Closure $next)
    {
        $cacheIps = Redis::keys('allowed-ip:*');
        $envIps = explode(',', env('CHECK_MAINTENANCE_MODE_IPS'));

        $allowedIps = $this->mergeAllowedIps($cacheIps, $envIps);

        if ($this->app->isDownForMaintenance() &&
            !in_array($request->getClientIp(), $allowedIps))
        {

            $maintenanceMode = new MaintenanceMode($this->app);
            return $maintenanceMode->handle($request, $next);
        }

        return $next($request);
    }

    private function mergeAllowedIps($cacheIps, $envIps)
    {
        foreach ($cacheIps as $key=>$ip){
            $cacheIps[$key] = str_replace('allowed-ip:','',$ip);
        }

        $allowedIps = array_unique(array_merge($cacheIps, $envIps));

        return $allowedIps;
    }
}
