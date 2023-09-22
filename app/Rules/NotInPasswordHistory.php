<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class NotInPasswordHistory implements Rule
{
    protected User $user;
    private int $depth;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user, $depth = 10)
    {
        $this->user = $user;
        $this->depth = $depth;
    }

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
        return ! $this->inHistory($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return sprintf('Şifreniz son %d şifrenizden farklı olmalıdır.', $this->depth);
    }

    /**
     * Check if password is in the password history
     *
     * @param $value
     *
     * @return bool
     */
    private function inHistory($value): bool
    {
        $passwordHistory = $this->user->passwordHistory()->latest()->take($this->depth)->get();
        foreach ($passwordHistory as $password) {
            if (Hash::check($value, $password->password)) {
                return true;
            }
        }
        return false;
    }
}
