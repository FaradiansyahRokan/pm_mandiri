<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    /**
     * Display product details.
     */
    public function showDetail($id)
    {
        $products = Product::findOrFail($id);
        $category = Category::all();
        return view('pages.detail', compact('products', 'category'));
    }
    public function showCart()
    {
        $cartItems = Cart::where('id_user', Auth::user()->id)->with('product')->get();
        $category = Category::all();
        return view('pages.cart', compact('cartItems' , 'category'));
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
}
