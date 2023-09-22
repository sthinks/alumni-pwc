<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFactor
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
        if ($user->two_factor_code) {
            if (! $request->is('2fa*')) {
                return redirect()->route('2fa.display');
            }
        }
        return $next($request);
    }
}
