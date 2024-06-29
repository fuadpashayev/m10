<?php

namespace App\Enums\Transaction;

enum TransactionType: string
{
    case payment = 'payment';

    case transfer = 'transfer';

    case withdrawal = 'withdrawal';

    case deposit = 'deposit';
}
