<?php

namespace App\Http\Controllers;

use App\Models\CategoryMenu;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        $category = CategoryMenu::all();
        $user = User::find(auth()->id());
        
        // dd($category);
        return view('index', compact('products', 'category' , 'user'));
    }
}
