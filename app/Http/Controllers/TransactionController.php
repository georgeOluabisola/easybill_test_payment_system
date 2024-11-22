<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;

class TransactionController extends Controller
{
      /**
     * Display a listing of transactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('user')->get(); // Load the associated user
        return TransactionResource::collection($transactions);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure the user exists
            'amount' => 'required|numeric|min:0.01',
            'status' => 'required|string|in:pending,completed,canceled', // Example statuses
        ]);

        $transaction = Transaction::create($validated);

        return new TransactionResource($transaction);
    }

    /**
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        // Ensure the associated user is loaded
        $transaction->load('user');
        return new TransactionResource($transaction);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'amount' => 'sometimes|required|numeric|min:0.01',
            'status' => 'sometimes|required|string|in:pending,completed,canceled',
        ]);

        $transaction->update($validated);

        return new TransactionResource($transaction);
    }

    /**
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->noContent();
    }
}
