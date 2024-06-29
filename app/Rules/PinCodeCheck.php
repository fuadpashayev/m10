<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PinCodeCheck implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (request()->route('transaction')->pin_code !== md5($value)) {
            $fail('The pin code is incorrect.');
        }
    }
}
