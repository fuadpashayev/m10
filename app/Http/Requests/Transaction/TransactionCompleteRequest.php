<?php

namespace App\Http\Requests\Transaction;

use App\Rules\PinCodeCheck;
use Illuminate\Foundation\Http\FormRequest;

class TransactionCompleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pin_code' => ['required', 'numeric', 'digits:6', new PinCodeCheck],
        ];
    }
}
