<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role  )
    {
        // if ($role) {
        //    dd(session('role'));
            if (session('role') !== $role) {
                abort(403, 'Unauthorized action.');
            }

        return $next($request);
    }

}