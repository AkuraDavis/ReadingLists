<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;

class ValidReCaptcha implements Rule
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
        if(env('RECAPTCHA_SECRET') == ''){
            //reCAPTCHA is off
            return true;
        }

        $recaptcha = new ReCaptcha(env('RECAPTCHA_SECRET'));
        $check = $recaptcha->verify($value, $_SERVER['REMOTE_ADDR']);
        if($check->isSuccess()){
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
        return 'Prove you are human, beat the reCAPTCHA.';
    }
}
