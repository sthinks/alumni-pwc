<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IpMiddleware
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
        // $whiteList = config('ip.allowed');
        // if (!in_array($request->ip(), $whiteList) && !preg_match('/^192/', $request->ip())) {
        //     Log::error('IP address is not whitelisted', ['ip address', $request->ip()]);
        //     return response()->json([
        //         'message' => 'You are not authorized to see this page',
        //         'ip' => $request->ip(),
        //         'tz' => date('Y-m-d H:i:s'),
        //     ], 403);
        // }
        return $next($request);
    }
}
