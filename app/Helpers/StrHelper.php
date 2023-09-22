<?php

namespace App\Helpers;

use InvalidArgumentException;

class StrHelper
{
    /**
     * Get file extension
     *
     * @param string $fileName
     *
     * @return string
     */
    public static function getFileExtension(string $fileName): string
    {
        return strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    }

    /**
     * Split name and surname into pieces
     *
     * @param string $name Name of user
     * @param string $wanted Whether name or surname is wanted
     *
     * @return string
     */
    public static function splitName(string $name, string $wanted = 'name'): string
    {
        $parts = explode(' ', $name);
        if (count($parts) > 1) {
            $lastname = array_pop($parts);
            $firstname = implode(' ', $parts);
        } else {
            $firstname = $name;
            $lastname = ' ';
        }
        if ($wanted === 'name') {
            return $firstname;
        }
        if ($wanted === 'surname') {
            return $lastname;
        }
        throw new InvalidArgumentException('Only name or surname is supported');
    }

    /**
     * Mask phone number
     *
     * @param string $phone
     *
     * @return string
     */
    public static function maskPhone(string $phone): string
    {
        $last_four = mb_substr($phone, -4);
        return sprintf('*** *** %s %s', mb_substr($last_four, 0, 2), mb_substr($last_four, 2, 4));
    }

    /**
     * Convert string to null if empty otherwise return string
     *
     * @param string $str
     *
     * @return string|null
     */
    public static function checkStringForEmpty(string $str): ?string
    {
        if ($str === '') {
            return null;
        }
        return $str;
    }

    /**
     * Get First Sentence
     *
     * @param string $text
     *
     * @return string
     */
    public static function getFirstSentence(string $content): string
    {
        $sentences = explode('.', $content);
        return trim($sentences[0]);
    }
}
