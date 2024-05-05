<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductGalleryRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\CategoryFlavour;
use App\Models\CategoryMenu;
use App\Models\CategorySize;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_flavours = CategoryFlavour::all();
        $data_menus = CategoryMenu::all();
        $data_sizes = CategorySize::all();

        return view('pages.forms', compact(['data_flavours', 'data_menus', 'data_sizes']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, Product $product)
    {
        $dataProduct = [
            'name_product' => $request->input('name_product'),
            'description_product' => $request->input('description_product'),
            'price' => $request->input('price'),
            'qty' => $request->input('qty'),
            'id_category_flavour' => $request->input('id_category_flavour'),
            'id_category_size' => $request->input('id_category_size'),
            'id_category_menu' => $request->input('id_category_menu'),
            // 'image_product' => $request->file('image_product')->store('public/gallery'),
        ];

        
        // dd($request);
        
        // $dataProduct = new Product();
        
        // $dataProduct->name = $request->name;
        // $dataProduct->category = $request->category;
        // $dataProduct->price = $request->price;
        // $dataProduct->qty = $request->qty;
        // $dataProduct->description = $request->description;
        
        if ($request->hasFile('image_product')){
            // $image = $request->file('image');
            $imageName = time() . '.' . $request->file('image_product')->getClientOriginalExtension();
            $request->file('image_product')->storeAs('public/gallery' , $imageName);
            $dataProduct['image_product'] = "storage/gallery/" .$imageName; 
        }
        Product::create($dataProduct);
    
            // $dataProduct->save();
            //  Product::create($dataProduct);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
