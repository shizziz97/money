<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPhone implements Rule
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
         // check if it's start with 09
         $str = strpos($value , '09' ,0);
         if($str === 0 && strlen($value) == 10 && ctype_digit($value)) 
         return true ;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'check your number';
    }
}
