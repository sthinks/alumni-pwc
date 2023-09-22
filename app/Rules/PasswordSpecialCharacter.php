<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordSpecialCharacter implements Rule
{
    public const ALLOWEDCHARS = "!\"#$%&'()*+,-.:;<=>?@[]^_{|}~";

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $string = str_split($value);
        $chars = str_split(self::ALLOWEDCHARS);
        $intersect = array_intersect($string, $chars);
        return count($intersect) > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return sprintf(
            'Yalnızca (%s) özel karakterlerine izin verilmektedir',
            self::ALLOWEDCHARS
        );
    }
}
