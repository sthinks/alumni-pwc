<?php

namespace App\HttpLogger\Contracts;

use Illuminate\Http\Request;

/**
 * Interface for log writers
 */
interface LogWriter
{
    public function logRequest(Request $request);
}
