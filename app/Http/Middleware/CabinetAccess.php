<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CabinetAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $role = \Auth::user()->role;
        if ($role != User::ROLE_DOCTOR && $role != User::ROLE_MEDCENTER)
            abort(403, 'Unathorized access!');
        return $next($request);
    }
}
