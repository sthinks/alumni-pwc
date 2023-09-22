<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckForDirectoryPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->consent('directory')) {
            return response()->view('alumni.community.permission');
        }
        return $next($request);
    }
}
