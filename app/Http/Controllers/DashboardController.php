<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
        $cat = $data->categoryFlavour()->get();
        return view('admin.admin', [ 'data' => $data, 'cat' => $cat]);
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
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validated();
        
        $product->update([
            'name_product' => $validatedData['name_product'],
            'description_product' => $validatedData['description_product'],
            'price' => $validatedData['price'],
            'qty' => $validatedData['qty'],
            'id_category_flavour' => $validatedData['id_category_flavour'],
            'id_category_size' => $validatedData['id_category_size'],
            'id_category_menu' => $validatedData['id_category_menu'],
        ]);

        if ($request->hasFile('image_product')) {
            Storage::delete($product->image_product);
            $product->image_product = $request->file('image_product')->store('public');
            $product->save();
        }

        // dd($request);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
