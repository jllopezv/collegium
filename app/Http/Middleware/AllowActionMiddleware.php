<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowActionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  String|Array $slug
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $model, $action)
    {
        $id=$request->route()->parameters()['id'];
        $record=$model::find($id);
        if (is_null($record)) abort(404);
        switch($action)
        {
            case 'edit':
                if (!$record->allowEdit()) abort(403);
                break;
            case 'show':
                if (!$record->allowShow()) abort(403);
                break;
        }
        return $next($request);
    }
}
