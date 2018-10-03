<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (\Auth::guest())
            return redirect('/login');
        if ($role == 'superuser' && \Auth::user()->role != 1) {
            abort(403, 'Unauthorized action.');
        } else if ($role == 'seo' && \Auth::user()->role != 1 && \Auth::user()->role != 7) {
            abort(403, 'Unauthorized action.');
        } else if ($role == 'superdev' && \Auth::user()->role != 1) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

}