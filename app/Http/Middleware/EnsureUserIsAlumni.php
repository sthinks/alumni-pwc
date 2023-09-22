<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAlumni
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! auth()->user()->isAlumni()) {
            if (auth()->user()->isAdmin()) {
                return redirect()->route('manager.homepage');
            }
        }
        return $next($request);
    }
}
