<?php

namespace App\HttpLogger;

use App\HttpLogger\Contracts\LogProfile;
use Illuminate\Http\Request;

class LogNonGetRequests implements LogProfile
{
    /**
     * What type of requests should be logged
     *
     * @param Request $request
     *
     * @return bool
     */
    public function shouldLogRequest(Request $request): bool
    {
        return in_array(strtolower($request->method()), ['post', 'put', 'patch', 'delete']);
    }
}
