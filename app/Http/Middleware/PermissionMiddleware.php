<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  String|Array $slug
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $slug)
    {
        if (!$request->user()->hasAbility($slug))
        {
            abort(403);
        }
        return $next($request);
    }
}
