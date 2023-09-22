<?php

namespace App\Http\Middleware;

use App\HttpLogger\Contracts\LogProfile;
use App\HttpLogger\Contracts\LogWriter;
use Closure;
use Illuminate\Http\Request;

class HttpLogger
{
    protected LogProfile $logProfile;
    protected LogWriter $logWriter;

    public function __construct(LogProfile $logProfile, LogWriter $logWriter)
    {
        $this->logProfile = $logProfile;
        $this->logWriter = $logWriter;
    }

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
        $response = $next($request);
        if ($this->logProfile->shouldLogRequest($request)) {
            $this->logWriter->logRequest($request);
        }
        return $response;
    }
}
