<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
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
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $numStr = preg_replace("/[^0-9]/", '', $value);
        $isValid = false;
        if (strlen($numStr) == 11) {
            $numStr = preg_replace("/^7/", '', $numStr);
            if (strlen($numStr) == 10)
                $isValid = true;

        }
        return $isValid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Введите действительный мобильный номер.';
    }
}
