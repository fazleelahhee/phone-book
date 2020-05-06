<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class IsAdminUser implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $users = User::where('email', '=', $value)->first();

        if (!$users) {
            return false;
        }

        if ($users->user_type == 'admin') {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'These credentials do not match our records.';
    }
}
