<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::with(['image_product'])->latest()->get();

        // return view('', compact('products'));

        return view('pages.detail');
    }

    public function cartAdd(Request $request, $id) {
        Cart::create([
            'id_user' => Auth::user()->id,
            'id_product' => $id
        ]);
        return redirect();
    }

    public function cartDelete(Request $request, $id) {
        Cart::findOrFail($id)->delete();

        return redirect();
    }

    public function category($id) {
        $categories = Category::all();
        $products = Product::where('category_id', $id)->get();

        return view();
    }
}
