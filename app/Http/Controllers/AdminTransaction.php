<?php
namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class AdminTransaction extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('user')->get();

        return view('admin.admin-transaction', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transactions = Transaction::findOrFail($id);
        $transactionItems = TransactionItem::where('id_transaction', $transactions->id)->get();

        // dd($transactions, $transactionItems);

        return view('admin.admin-show-transaction', compact(['transactions', 'transactionItems']));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->all());

        return redirect()->route('');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){

    }
};
