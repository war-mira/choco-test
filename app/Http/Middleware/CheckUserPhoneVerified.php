<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserPhoneVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        if (!$user->phone_verified && !$request->routeIs('user.phone.*'))
            return redirect(route('user.phone.verification.form'));
        return $next($request);
    }
}
