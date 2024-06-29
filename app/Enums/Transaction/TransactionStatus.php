<?php

namespace App\Enums\Transaction;

enum TransactionStatus: string
{
    case pending = 'pending';
    case approved = 'approved';
    case declined = 'declined';
}
