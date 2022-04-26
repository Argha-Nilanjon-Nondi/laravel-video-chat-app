<?php

namespace App\Rules;

use App\Models\EmailVerify;
use Illuminate\Contracts\Validation\Rule;

class TempTokenExist implements Rule
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
        $user = EmailVerify::where("temp_token", $value);
        if ($user->count() > 0) {
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
        return [["code" => 3015, "message" => "temp_token is not found"]];
    }
}
