<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class FileHelper
{
    /**
     * Generate file name
     *
     * @param string $file
     * @param string $extension
     *
     * @return string
     */
    public static function generateFileName(string $file, string $extension): string
    {
        $file = mb_substr($file, 0, 80);
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        $slugged = Str::slug(self::sanitize($fileName));
        $randomString = uniqid();
        return sprintf('%s___%s.%s', $slugged, $randomString, $extension);
    }

    /**
     * Function: sanitize
     * Returns a sanitized string, typically for URLs.
     *
     * Parameters:
     *     $string - The string to sanitize.
     *     $force_lowercase - Force the string to lowercase?
     *     $anal - If set to *true*, will remove all non-alphanumeric characters.
     */
    public static function sanitize($string, $anal = false)
    {
        $strip = [
            '~', '`', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '=', '+', '[', '{',
            '}', '\\', '|', ';', ':', '"', "'", '&#8216;', '&#8217;', '&#8220;', '&#8221;',
            'â€”', 'â€“', ',', '<', '.', '>', '/', '?', 'CON', 'PRN', 'AUX', 'CLOCK$', 'NUL',
            'COM5', 'COM6', 'COM7', 'COM8', 'COM9', 'LPT0', 'LPT1', 'LPT2', 'LPT3',
            'LPT4', 'COM0', 'COM1', 'COM2', 'COM3', 'COM4',
            'LPT5', 'LPT6', 'LPT7', 'LPT8', 'LPT9', '&#8211;', '&#8212;', ']',
            '?', '[', ']', '/', '\\', '=', '<', '>', ':', ';', ',', "'", '"',
            '&', '$', '#', '*', '(', ')', '|', '~', '`', '!', '{', '}', '%',
            '+', '’', '«', '»', '”', '“', chr(0),
        ];
        $clean = trim(str_replace($strip, '', strip_tags($string)));
        $clean = filter_var($clean, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clean = preg_replace('/\s+/', ' ', $clean);
        return $anal ? preg_replace('/[^a-zA-Z0-9]/', '', $clean) : $clean;
    }

    /**
     * Get file name from generated string
     *
     * @param string $file
     *
     * @return string
     */
    public static function extractFileName(string $file): string
    {
        $fileName = basename($file);
        $fileName = explode('___', $fileName);
        if (count($fileName) > 1) {
            return Str::title(str_replace('-', ' ', $fileName[0]));
        }
        return 'Ekli dosyayı indir';
    }
}
