<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EmailUpdateRule implements Rule
{
    private $user;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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

        /**
         * User current email - no need to check
         */
        if ($this->user->email == $value || $this->user->original_email == $value) {
            return true;
        }

        $hasEmail = User::where([
            ['email', '=', $value]
        ])->orWhere([
            ['original_email', '=', $value]
        ])->get();

        if ($hasEmail->count() == 0) {
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
        return 'The email has already been taken.';
    }
}
