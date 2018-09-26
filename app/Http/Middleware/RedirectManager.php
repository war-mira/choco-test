<?php

namespace App\Http\Middleware;

use App\Helpers\RoutePathfinder;
use Closure;

class RedirectManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $from = $request->path();

//        dd( $from);
        if($go = RoutePathfinder::get($from))
            return redirect($go->to,$go->code);

        return $next($request);
    }
}
