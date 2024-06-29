<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class TransactionGenerateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric',
            'payer_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'type' => 'required|string|in:transfer,deposit,withdraw,payment',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'receiver_id' => $this->user()->getAttribute('id'),
        ]);
    }
}
