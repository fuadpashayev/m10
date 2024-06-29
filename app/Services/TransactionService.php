<?php

namespace App\Services;

use App\Enums\Transaction\TransactionStatus;
use App\Http\Requests\Transaction\TransactionGenerateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionService
{
    public function generate(array $data)
    {
        /**
         * 'receiver_id',
         * 'payer_id',
         * 'amount',
         * 'type',
         * 'status',
         * 'pin_code',
         * 'pin_expires_at',
         * 'approved_at',
         * 'declined_at'
         */

        $data = array_merge(
            $data,
            $this->setPinCode($data) + [
                'status' => TransactionStatus::pending->value,
            ]);


        return User\Transaction::query()->create($data);
        dd($data);
    }


    public function setPinCode($data)
    {

        $payer = User::query()->find($data['payer_id']);

        $pinCode = $payer->getAttribute('pin_code');

        $pinExpiresAt = null;

        $otp_balance_limit = $payer->getAttribute('otp_balance_limit');

        if ($otp_balance_limit >= $data['amount']) {
            # send to email

            $pinCode = rand(1000, 9999);

            # send to email end

            $pinCode = md5($pinCode);

            $pinExpiresAt = now()->addMinutes(5);
        }

        return [
            'pin_code' => $pinCode,
            'pin_expires_at' => $pinExpiresAt
        ];
    }
}
