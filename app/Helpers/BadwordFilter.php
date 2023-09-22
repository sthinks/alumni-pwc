<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;

class BadwordFilter
{
    /**
     * Filter out censored words
     *
     * @param string $text
     *
     * @return array|string|null
     */
    public static function filter(string $text)
    {
        return preg_replace(static::generateRegex(), '****', $text);
    }

    /**
     * Regex generator for censored words
     * This function also fixes Turkish character problems like iİ
     *
     * @return array
     */
    private static function generateRegex(): array
    {
        $words = Config::get('censored', []);
        return array_map(function ($swear) {
            $turkish = ['i', 'ü', 'ğ', 'ç', 'ö'];
            $english = ['[iİ]', '[üÜ]', '[ğĞ]', '[çÇ]', '[öÖ]'];
            $swear = str_ireplace($turkish, $english, $swear);
            return '/\b' . $swear . '\b/ui';
        }, $words);
    }
}
