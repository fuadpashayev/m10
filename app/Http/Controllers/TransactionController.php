<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\TransactionCompleteRequest;
use App\Http\Requests\Transaction\TransactionGenerateRequest;
use App\Models\User\Transaction;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function __construct(public TransactionService $service)
    {
    }

    public function receive()
    {
        return view('receive.index');
    }

    public function generate(TransactionGenerateRequest $request)
    {
        $transaction = $this->service->generate(
            $request->validated()
        );

        return response()->json([
            'message' => 'Transaction created successfully. Please enter your pin code to proceed.',
            'transaction_id' => $transaction->id
        ]);
    }

    public function complete(TransactionCompleteRequest $request, Transaction $transaction)
    {
        $this->service->complete($transaction, $request->validated());

        return response()->json([
            'message' => 'Transaction completed successfully.'
        ]);
    }

}
