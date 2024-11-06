<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!is_null(request()->user()) &&
            (request()->user()->position == "SUPERADMIN" || request()->user()->position == "ADMIN")) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
