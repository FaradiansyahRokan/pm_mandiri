<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PDF;

class CheckoutController extends Controller
{
    public function downloadReceipt(Transaction $transaction)
    {
        if (auth()->id() !== $transaction->id_user) {
            abort(403);
        }
        $user = User::find(auth()->id());
        $address = Address::where('id_user', $user->id)->first();
        $transactionItems = TransactionItem::all();
        $pdf = FacadePdf::loadView('pages.receipt', compact('transaction' , 'address', 'transactionItems'));

        return $pdf->download('receipt.pdf');
    }
}
