<?php

use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AdminMiddleware;
use Database\Seeders\AdminSeeder;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
 
    $token = csrf_token();
});
Route::middleware(['auth'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/detail/{id}', [FrontendController::class, 'showDetail'])->name('detail');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/products/category/{categoryId}', [ProductController::class, 'showByCategory'])->name('products.category');
Route::post('/cart/add/{id}', [FrontendController::class, 'cartAdd'])->name('cart.add');
Route::post('/cart/delete/{id}', [FrontendController::class, 'cartDelete'])->name('cart.delete');
Route::post('/cart/update/{id}', [FrontendController::class, 'updateCart'])->name('cart.update');
Route::get('/cart', [FrontendController::class, 'showCart'])->name('cart');



});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
//     Route::get('/detail/{id}', [App\Http\Controllers\FrontendController::class, 'showDetail'])->name('detail');
//     Route::put('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
// });

Route::middleware([AdminMiddleware::class])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/create' , [ProductController::class , 'create'])->name('product');
    Route::get('/dashboard/add/category' , [CategoryController::class , 'create'])->name('category');
    Route::post('/dashboard/add/category' , [CategoryController::class , 'store'])->name('category-store');
    Route::post('/dashboard/create' , [ProductController::class , 'store'])->name('product-store');
    Route::get('/dashboard/show/{id}' , [DashboardController::class , 'show'])->name('show-product');
    Route::delete('/dashboard/show/{id}' , [DashboardController::class , 'destroy'])->name('delete');
    Route::get('/dashboard/edit/{id}' , [DashboardController::class , 'edit'])->name('edit');
    Route::patch('/dashboard/edit/{id}' , [DashboardController::class , 'update'])->name('update');
  // اضف المنتجات             
});
