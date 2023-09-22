<?php

namespace App\Filters;

use Closure;

/**
 * Interface for filtering contexts
 */
interface FilterInterface
{
    public function handle($text, Closure $next);
}
