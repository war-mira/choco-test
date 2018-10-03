<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class DoctorCheck
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
        $doctor = \Auth::user()->doctor;
        $role = \Auth::user()->role;
        if(is_null($doctor) || $role !== User::ROLE_DOCTOR ){
            return redirect('/user/profile');
        } 

        return $next($request);
    }
}
