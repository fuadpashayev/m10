<?php

namespace App\Services;

use App\Enums\Transaction\TransactionStatus;
use App\Models\User;
use App\Models\User\Transaction;

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


        return Transaction::query()->create($data);
    }


    public function setPinCode($data): array
    {

        $payer = User::query()->find($data['payer_id']);

        $pinCode = $payer->getAttribute('pin_code');

        $pinExpiresAt = null;

        $otp_balance_limit = $payer->getAttribute('otp_balance_limit');

        if ($data['amount'] > $otp_balance_limit && $otp_balance_limit !== 0) {
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

    public function complete(Transaction $transaction)
    {
        if ($transaction->getAttribute('status') !== TransactionStatus::pending->value) {
            return [
                'status' => 'error',
                'message' => 'Transaction expired.'
            ];
        }

        $payer = $transaction->getAttribute('payer');

        if ($transaction->getAttribute('amount') > $payer->getAttribute('balance')) {
            $transaction->update([
                'status' => TransactionStatus::declined->value,
                'declined_at' => now()
            ]);

            return [
                'status' => 'error',
                'message' => 'Transaction declined. Insufficient balance.'
            ];
        }


        $payer->increment('balance', $transaction->getAttribute('amount'));

        $transaction->update([
            'status' => TransactionStatus::approved->value,
            'approved_at' => now()
        ]);

        return [
            'status' => 'success',
            'message' => 'Transaction completed successfully.'
        ];
    }
}
