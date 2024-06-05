<?php
namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Address;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminTransaction extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function detailIndex($id)
{
    $dataTransaction = Transaction::with('transactionItems.product', 'user', 'address')->findOrFail($id);
    $user = User::find(auth()->id());
    $address = Address::where('id_user', $user->id)->first();
    $transactionItems = TransactionItem::where('id_transaction', $dataTransaction->id)->first();

    $user->fullName = $user->first_name . ' ' . $user->last_name;

    // Format the address as a string
    $formattedAddress = $address ? "{$address->city}, {$address->province}, {$address->district}, {$address->detail}, {$address->address_type}" : 'Address not available';

    return view('pages.detail-transaction', compact('dataTransaction', 'user', 'formattedAddress', 'transactionItems'));
}

public function add(Request $request, $id)
{
    $this->validate($request, [
        'ongkir' => 'required',
    ]);

    // dd($request);

    $transaction = Transaction::findOrFail($id);
    $transaction->ongkir = $request->ongkir;
    $transaction->total_price += $request->ongkir;
    // $transaction->berat = $request->berat;
    $transaction->save();

    return redirect()->route('admin.transaction.detail', $id)->with('success', 'Ongkir added successfully!');
}

    public function showTransactions()
    {
        $transactions = Transaction::with('transactionItems.product', 'user')->get();
        $user = User::find(auth()->id());
        $address = Address::where('id_user', $user->id)->first();
        return view('pages.admin-transaction', compact('transactions', 'address'));
    }

    public function updateTransactionStatus(Request $request, $transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        $transaction->status = $request->status;
        // $transaction->ongkir = $request->ongkir;
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction status updated successfully!');
    }

    public function addShippingCost(Request $request)
    {
        $request->validate([
            'transactionId' => 'required|exists:transactions,id',
            'shippingCost' => 'required|numeric|min:0',
        ]);

        $transaction = Transaction::find($request->transactionId);
        $transaction->shipping_cost = $request->shippingCost;
        $transaction->total_price += $request->shippingCost;
        $transaction->save();

        return redirect()->back()->with('success', 'Shipping cost added successfully!');
    }

    public function exportPdf($id)
    {
        $user = User::find(auth()->id());
        $address = Address::where('id_user', $user->id)->first();
        $transaction = Transaction::with('transactionItems.product')->findOrFail($id);
        $dataTransaction = Transaction::with('transactionItems.product', 'user', 'address')->findOrFail($id);
        $transactionItems = TransactionItem::where('id_transaction', $dataTransaction->id)->first();

        $pdf = Pdf::loadView('pages.receipt-admin', compact('transaction', 'address', 'user' , 'dataTransaction' , 'transactionItems'));

        return $pdf->download('transaction'.$transaction->id.'.pdf');
    }
};
