<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    /**
     * Display product details.
     */
    public function showDetail($id)
    {
        $products = Product::findOrFail($id);
        $category = Category::all();
        $user = User::find(auth()->id());
        return view('pages.detail', compact('products', 'category' , 'user'));
    }

    public function showCart()
    {
        $cartItems = Cart::where('id_user', Auth::user()->id)->with('product')->get();
        $category = Category::all();
        $user = User::find(auth()->id());
        $address = Address::where('id_user', $user->id)->first();

        $totalPrice = $cartItems->sum(function($item) {
            return $item->product->price * $item->qty;
        });
        return view('pages.cart', compact('cartItems' , 'category' , 'user' , 'totalPrice' , 'address'));
    }

    public function showCheckout()
{
    $cartItems = Cart::where('id_user', Auth::user()->id)->with('product')->get();
    $category = Category::all();
    $user = User::find(auth()->id());
    return view('pages.checkout', compact('cartItems', 'category' , 'user'));
}

    /**
     * Add product to cart.
     */
    public function cartAdd(Request $request, $id)
    {
        $cartItem = Cart::where('id_user', Auth::user()->id)
                        ->where('id_product', $id)
                        ->first();
    
        if ($cartItem) {
            $cartItem->qty += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'id_user' => Auth::user()->id,
                'id_product' => $id,
                'qty' => 1
            ]);
        }
    
        return redirect()->route('cart')->with('success', 'Product added to cart successfully!');
    }

    public function updateCart(Request $request, $id)
{
    $cartItem = Cart::where('id_user', Auth::user()->id)
                    ->where('id_product', $id)
                    ->first();

    if ($cartItem) {
        $cartItem->qty = $request->quantity;
        $cartItem->save();
    }
    return redirect()->route('cart')->with('success', 'Cart updated successfully!');
}
    /**
     * Remove product from cart.
     */
    public function cartDelete(Request $request, $id)
    {
        Cart::where('id_user', Auth::user()->id)
            ->where('id_product', $id)
            ->delete();

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    /**
     * Display products by category.
     */
    public function category($id)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $id)->get();

        return view('pages.category', compact('categories', 'products'));
    }

    public function checkout(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();
        $address = Address::where('id_user', $user->id)->first();

        $data['id_address'] = $address->id;
        
        $carts = Cart::where('id_user', Auth::id())->with('product')->get();
        
        $data['id_user'] = Auth::id();
        $data['total_price'] = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->qty;
        });
        $data['notes'] = $request->notes;

        if (!$address) {
            return redirect()->back()->withErrors(['error' => 'No address found for the user.']);
        }
        
        $transaction = Transaction::create($data);
        
        foreach ($carts as $cart) {
            TransactionItem::create([
                'id_user' => $cart->id_user,
                'id_transaction' => $transaction->id,
                'id_product' => $cart->id_product,
                'qty' => $cart->qty,
                'price' => $cart->product->price,
                'total_price' => $cart->product->price * $cart->qty,
            ]);
        }

        Cart::where('id_user', Auth::id())->delete();
        
        // dd($data, $carts);
        return redirect()->route('checkout.detail', ['transaction' => $transaction->id])
        ->with('success', 'Checkout successful!');
    }


    public function showCheckoutDetail($transactionId)
    {
    $user = User::find(auth()->id());
    $category = Category::all();
    $transaction = Transaction::with('transactionItems.product')->findOrFail($transactionId);
    $allTransactions = Transaction::where('id_user', Auth::id())
        ->where('id', '!=', $transactionId)
        ->with('transactionItems.product')
        ->get();
    // dd($transaction);

    $ongoingTransactions = $allTransactions->filter(function ($trans) {
        return $trans->status !== 'ARRIVED';
    });

    $completedTransactions = $allTransactions->filter(function ($trans) {
        return $trans->status === 'ARRIVED';
    });

    session(['last_transaction_id' => $transaction->id]);

    if ($transaction->id_user !== Auth::id()) {
        return redirect()-> route('home', ['transaction' => $transaction->id]) ->withErrors(['error' => 'You do not have access to this transaction.']);
    }

    return view('pages.chekout-detail', compact('transaction' , 'category' , 'user' , 'allTransactions' , 'ongoingTransactions', 'completedTransactions'));
}

public function sendreceipt(Request $request): RedirectResponse
{
    $token = 'VWjxi5K9b9D2izb17DiQ';
    $target = '085109580607';
    $message = 'Halo! Aku udah checkout barang nih. Tolong kirimin aku harga ongkir nya dong. Aku tunggu yah!';

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('target' => $target, 'message' => $message),
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $token
        ),
    ));

    $response = curl_exec($curl);
    $error = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    // Log response and error for debugging
    Log::info('cURL Response: ' . $response);
    Log::error('cURL Error: ' . $error);
    Log::info('HTTP Code: ' . $httpCode);

    if ($error) {
        return redirect()->back()->withErrors(['error' => 'Failed to send message: ' . $error]);
    }

    if ($httpCode != 200) {
        return redirect()->back()->withErrors(['error' => 'Failed to send message. HTTP Code: ' . $httpCode]);
    }

    return redirect()->back()->with('success', 'Berhasil mengirim pesan.');
}
}