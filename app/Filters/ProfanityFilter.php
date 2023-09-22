<?php

namespace App\Filters;

use App\Helpers\BadwordFilter;
use Closure;
use Illuminate\Support\Facades\Config;

class ProfanityFilter implements FilterInterface
{
    /**
     * Filtering censored words
     *
     * @param $text
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($text, Closure $next)
    {
        $text = BadwordFilter::filter($text);
        return $next($text);
    }

    /**
     * Gets list of censored words
     *
     * @return mixed
     */
    public function getWords()
    {
        return Config::get('censored', []);
    }
}
