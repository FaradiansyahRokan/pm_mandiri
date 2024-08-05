<?php

namespace App\Http\Controllers;

use App\Models\CategoryFlavour;
use App\Models\CategoryMenu;
use App\Models\CategorySize;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        return view('pages.category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Inisialisasi array data kosong
        $dataCategoryFlavour = [];
        $dataCategoryMenus = [];
        $dataCategorySizes = [];

        // Periksa dan tambahkan data ke $dataCategoryFlavour jika tidak kosong
        if ($request->filled('list_flavour')) {
            $dataCategoryFlavour['list_flavour'] = $request->input('list_flavour');
        }

        // Periksa dan tambahkan data ke $dataCategoryMenus jika tidak kosong
        if ($request->filled('list_menu')) {
            $dataCategoryMenus['list_menu'] = $request->input('list_menu');
        }

        // Periksa dan tambahkan data ke $dataCategorySizes jika tidak kosong
        if ($request->filled('list_size')) {
            $dataCategorySizes['list_size'] = $request->input('list_size');
        }
        if ($request->filled('price')) {
            $dataCategorySizes['price'] = $request->input('price');
        }

        // Hanya buat entri baru jika ada data untuk disimpan
        if (!empty($dataCategoryFlavour)) {
            CategoryFlavour::create($dataCategoryFlavour);
        }
        if (!empty($dataCategoryMenus)) {
            CategoryMenu::create($dataCategoryMenus);
        }
        if (!empty($dataCategorySizes)) {
            CategorySize::create($dataCategorySizes);
        }

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
    }

    /*=
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category_flavour = CategoryFlavour::find($id)->delete();
        $category_menu = CategoryMenu::find($id)->delete();
        $category_size = CategorySize::find($id)->delete();

        return redirect();
    }
}
