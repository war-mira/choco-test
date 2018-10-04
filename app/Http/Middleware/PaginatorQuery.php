<?php

namespace App\Http\Middleware;

use Closure;

class PaginatorQuery
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
        if($request->query('page') == 1)
            return redirect()->to(url()->current())->with(array_except($request->query(),'page'));
        return $next($request);
    }
}
