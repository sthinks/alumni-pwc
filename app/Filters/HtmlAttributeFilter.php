<?php

namespace App\Filters;

use Closure;

class HtmlAttributeFilter implements FilterInterface
{
    /**
     * Handles attribute filtering removes unwanted attributes
     *
     * @param $text
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($text, Closure $next)
    {
        $text = str_replace('javascript:', '', $text);
        $text = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/si", '<$1$2>', $text);
        return $next($text);
    }
}
