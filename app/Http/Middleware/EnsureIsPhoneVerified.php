<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsPhoneVerified
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
        if (! auth()->user()->hasVerifiedPhone()) {
            return redirect()->route('verification.phone.notice');
        }
        return $next($request);
    }
}
