<?php

namespace App\Filters;

use Closure;

class RemoveTags implements FilterInterface
{
    /**
     * Removes disallowed html tags
     *
     * @param $text
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($text, Closure $next)
    {
        $text = strip_tags($text, '<p><em><strong>');
        return $next($text);
    }
}
