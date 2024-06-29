<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\TransactionGenerateRequest;
use App\Models\User\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(public TransactionService $service)
    {
    }

    public function generate(TransactionGenerateRequest $request)
    {
        $transaction = $this->service->generate(
            $request->validated()
        );

        return redirect()->route('transactions.payment', $transaction)->with([
            'message' => 'Transaction created successfully. Please enter your pin code to proceed.'
        ]);
    }

    public function payment(Transaction $transaction)
    {
        dd($transaction);
    }
}
