<?php

namespace App\Http\Middleware;

use App\Helpers\SessionContext;
use Closure;
use URL;

class SetDefaultCityForUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $city = SessionContext::city();
        URL::defaults(['city' => $city->alias]);

        return $next($request);
    }
}
