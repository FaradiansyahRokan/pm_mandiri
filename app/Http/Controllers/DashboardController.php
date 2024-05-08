<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\CategoryFlavour;
use App\Models\CategoryMenu;
use App\Models\CategorySize;
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
        // $data = Product::get();
        // $cat_flavs = $data->categoryFlavour()->get();
        // return view('admin.admin', [ 'data' => $data, 'cat' => $cat_flavs]);


         $products = Product::all();

         $categoryFlavours = CategoryFlavour::whereIn('id', $products->pluck('id_category_flavour'))->get();
         $categorySizes = CategorySize::whereIn('id', $products->pluck('id_category_size'))->get();
         $categoryMenus = CategoryMenu::whereIn('id', $products->pluck('id_category_menu'))->get();
         
         return view('admin.admin', [
             'data' => [
                 'products' => $products,
                 'categoryFlavours' => $categoryFlavours,
                 'categorySizes' => $categorySizes,
                 'categoryMenus' => $categoryMenus,
             ]
         ]);
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
        $showData =  Product::findOrfail($id);
        return view('pages.show' , compact('showData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataEdit = Product::findOrFail($id);
        $data_flavours = CategoryFlavour::all();
        $data_menus = CategoryMenu::all();
        $data_sizes = CategorySize::all();

        return view('pages.edit', compact(['dataEdit', 'data_flavours', 'data_menus', 'data_sizes']));
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

        if ($request->hasFile('image_product')){
            // $image = $request->file('image');
            $imageName = time() . '.' . $request->file('image_product')->getClientOriginalExtension();
            $request->file('image_product')->storeAs('public/gallery' , $imageName);
            $dataProduct['image_product'] = "storage/gallery/" .$imageName; 
        }

        // dd($request);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        $product->findOrFail($id)->delete();
        return redirect()->route('dashboard');
    }
}
