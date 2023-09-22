<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotVerifiedSecondEmail
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

        if ($user->hasVerifiedSecondMail()) {
            return redirect()->route('profile.index');
        }

        return $next($request);
    }
}
