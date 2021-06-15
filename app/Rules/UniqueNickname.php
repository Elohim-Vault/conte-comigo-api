<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;

class UniqueNickname implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return !User::find(Auth::id())->account->contains('nickname', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Esse apelido de conta já existe.';
    }
}
