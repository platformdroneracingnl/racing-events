<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CurrentPasswordCheckRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     */
    public function passes($attribute, $value): bool
    {
        return Hash::check($value, auth()->user()->password);
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return __('The current password does not match the password you entered');
    }
}
