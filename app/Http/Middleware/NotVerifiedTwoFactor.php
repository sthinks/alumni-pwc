<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotVerifiedTwoFactor
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
        $user = auth()->user();
        if (! $user->two_factor_code) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
