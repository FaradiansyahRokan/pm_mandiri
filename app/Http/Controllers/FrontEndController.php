<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CategoryFlavour;
use App\Models\CategoryMenu;
use App\Models\CategorySize;
use App\Models\TokenWhatsapp;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\Bool_;

class FrontendController extends Controller
{
    /**
     * Display product details.
     */

    public function showDetail($id)
    {
        $user = User::find(auth()->id());
        $products = Product::findOrFail($id);
        $categorySize = CategorySize::where('id', $products->id_category_size)->first();
        $category = CategoryMenu::all();
        
        return view('pages.detail', compact('products', 'category', 'categorySize', 'user'));
    }

    public function showCart()
{
    $cartItems = Cart::where('id_user', Auth::user()->id)->with(['product.categorySize'])->get();
    $user = User::find(auth()->id());
    $categorySize = CategorySize::all();
    $address = Address::where('id_user', $user->id)->first();
    $category =  CategoryMenu::all();

    // dd($cartItems);

    // $totalPrice = $cartItems->sum(function($item) {
    //     return $item->product->categorySize ? $item->product->categorySize->price * $item->qty : 0;
    // });

    $totalPrice = $cartItems->sum(function($item) {
        return optional($item->product->size)->price * $item->qty;
    });

    return view('pages.cart', compact('cartItems', 'category', 'categorySize', 'user', 'totalPrice', 'address'));
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
    $user = Auth::user();
    $address = Address::where('id_user', $user->id)->first();

    if (!$address || !$address->city) {
        return redirect()->route('profile')->with('alert', 'Anda belum memiliki alamat pengiriman. Silakan tambahkan alamat terlebih dahulu.');
    }

    // Fetch the product using the product ID
    $product = Product::with('categorySize')->find($id);

    // Ensure the product exists
    if (!$product) {
        return redirect()->route('cart')->with('error', 'Product not found');
    }

    // Fetch the category sizes from the product
    $categorySizes = $product->categorySize; // Assuming `categorySize` is a relationship

    // // Ensure the category sizes exist
    // if ($categorySizes->isEmpty()) {
    //     return redirect()->route('cart')->with('error', 'Category sizes not found');
    // }

    // Retrieve the selected size ID from the request
    $defaultSizeId = $request->input('id_size') ?? $categorySizes->first()->id;

    // Check if the cart item already exists for the user and product
    $cartItem = Cart::where('id_user', $user->id)
                    ->where('id_product', $id)
                    ->first();

    if ($cartItem) {
        // Update the quantity and size if the item already exists in the cart
        $cartItem->qty += 1;
        $cartItem->id_size = $defaultSizeId; // Update the size if needed
        $cartItem->save();
    } else {
        // Create a new cart item if it doesn't exist
        Cart::create([
            'id_user' => $user->id,
            'id_product' => $id,
            'qty' => 1,
            'id_size' => $defaultSizeId, // Set the selected size
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
if ($request->has('quantity')) {
$cartItem->qty = $request->quantity;
}
if ($request->has('id_size')) {
$cartItem->id_size = $request->id_size;
}
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

    // public function updateSize(Request $request, $id)
    // {
    //     $cartItem = Cart::where('id_user', auth()->id())->where('id_product', $id)->first();

    //     if ($cartItem) {
    //         $cartItem->size = $request->input('size');
    //         $cartItem->price = $request->input('price'); // Update price according to size
    //         $cartItem->save();
    //     }

    //     return redirect()->route('cart')->with('success', 'Size updated successfully!');
    // }

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
            return $cart->size->price * $cart->qty;
        });
        $data['notes'] = $request->notes;
        // $data['ongkir'] = $request->ongkir;

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
                'price' => $cart->size->price,
                'total_price' => $cart->size->price * $cart->qty,
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
    $address = Address::where('id_user', $user->id)->first();
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

     $button = true;
     $a = $transaction['request_ongkir_time'];

     if ($a === null) {
         $tombol = true; // Jika waktu null, tombol aktif
     } else {
         $dateTime = date_create_from_format('Y-m-d H:i:s', $a);
         $currentDateTime = new DateTime(); // Waktu saat ini
         $diff = $currentDateTime->diff($dateTime); // Perbedaan antara waktu saat ini dan waktu permintaan ongkir
     
         // Menghitung selisih waktu dalam menit
         $diffMinutes = ($diff->days * 24 * 60) +
             ($diff->h * 60) +
             $diff->i;
     
         if ($diffMinutes > 30) {
             $tombol = true; // Jika lebih dari 30 menit, tombol aktif
         } else {
             $tombol = false; // Jika kurang dari 30 menit, tombol tidak aktif
         }
     }
     

// dd($tombol);
    

    return view('pages.chekout-detail', compact('transaction' , 'category' , 'user' , 'allTransactions' , 'ongoingTransactions', 'completedTransactions', 'address', 'tombol'));
}

public function requestOngkir(Request $request)
{

    //  $transaction = Transaction::where('id', $request['id_transaction'])->first();
    $transaction = Transaction::where('id', $request['transaction_id'])->first();


    // Key untuk menyimpan timestamp request terakhir
    // $cooldownKey = 'request_ongkir_' . $transaction->id;
    // dd($cooldownKey);

    // Ambil timestamp request terakhir dari cache
    // $lastRequestTime = Cache::get($cooldownKey);
    // if ($transaction) {
    //     // Key untuk menyimpan timestamp request terakhir
    //     $cooldownKey = 'request_ongkir_' . $transaction->id;
    // } else {
    //     // Tangani kasus ketika transaksi tidak ditemukan
    //     return response()->json(['error' => 'Transaction not found'], 404);
    // }

    // if ($lastRequestTime) {
    //     $elapsedTime = Carbon::now()->diffInMinutes(Carbon::parse($lastRequestTime));

    //     if ($elapsedTime < 30) {
    //         $timeLeft = 30 - $elapsedTime;
    //         return redirect()->back()->with('message', "Tunggu $timeLeft menit sebelum mengajukan request ongkir lagi.");
    //     }
    // }

    // Coba mengirim notifikasi ke WhatsApp
    if (!$this->sendreceipt($transaction)) {
        return redirect()->back()->with('error', 'Gagal mengirim pesan. Silakan coba lagi.');
    }

    // Simpan timestamp request terbaru ke cache
    // Cache::put($cooldownKey, Carbon::now(), 30 * 60); // Simpan selama 30 menit

    $transaction->request_ongkir_time = now();
    $transaction->save();

    return redirect()->back()->with('message' , 'Request anda berhasil dikirmkan ke Admin! Mohon tunggu Admin meresponnya.');
}

private function sendreceipt($transaction): RedirectResponse
{
    // $request->id;
    // $user = User::find();
    // $transaction = TransactionItem::where('id_user', $user->id);
    // dd($transaction);
    $user = $transaction->user;
    $nope = TokenWhatsapp::first();
    $token = $nope->token_wa;
    // $target = '0895365168786';
    $message = "Halo! Ada request orderan masuk min!
    \nId transaksi: #$transaction->id.
    \nPemesan : $user->first_name $user->last_name.
    \nMohon segera proses transaksi tersebut dengan mengirimkan harga ongkirnya yah.";

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
        CURLOPT_POSTFIELDS => array('target' => $nope->target_wa, 'message' => $message),
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

    return redirect()->back();
}

}