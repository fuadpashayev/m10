<?php

namespace App\Rules;

use App\Models\User\PinCode;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class PinCodeUnique implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $id = Auth::id();

        $value = md5($value);

        if (PinCode::query()->where('user_id', $id)->where('pin_code', $value)->exists()) {
            $fail('You have used this :attribute before, please enter another :attribute');
        }
    }
}
