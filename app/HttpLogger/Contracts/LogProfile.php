<?php

namespace App\HttpLogger\Contracts;

use Illuminate\Http\Request;

/**
 * Interface for log profiles
 */
interface LogProfile
{
    public function shouldLogRequest(Request $request);
}
