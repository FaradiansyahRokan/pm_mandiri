<?php

use App\Http\Controllers\AdminTransaction;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Middleware\AdminMiddleware;
use Database\Seeders\AdminSeeder;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
// Route::get('/token', function (Request $request) {
//     $token = $request->session()->token();
 
//     $token = csrf_token();
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail/{id}', [FrontendController::class, 'showDetail'])->name('detail');
Route::get('/products/category/{categoryId}', [ProductController::class, 'showByCategory'])->name('products.category');

Route::middleware(['auth'])->group(function(){
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/cart/add/{id}', [FrontendController::class, 'cartAdd'])->name('cart.add');
Route::post('/cart/delete/{id}', [FrontendController::class, 'cartDelete'])->name('cart.delete');
Route::post('/cart/update/{id}', [FrontendController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/update-size/{id}', [FrontendController::class, 'updateSize'])->name('cart.updateSize');

Route::get('/cart', [FrontendController::class, 'showCart'])->name('cart');
Route::post('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::post('/checkout/contact', [FrontendController::class, 'sendreceipt'])->name('checkout.contact');
Route::get('/checkout/{transaction}', [FrontendController::class, 'showCheckoutDetail'])->name('checkout.detail');
Route::post('/checkout/request-ongkir/', [FrontendController::class, 'requestOngkir'])->name('checkout.requestOngkir');

Route::get('/checkout/download/{transaction}', [CheckoutController::class, 'downloadReceipt'])->name('checkout.download');

// Route::post('/admin/transactions/addShippingCost', [FrontendController::class, 'addShippingCost'])->name('admin.transactions.addShippingCost');
Route::get('/payment-steps', [FrontendController::class, 'paymentsteps'])->name('payment.steps');
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
    Route::get('/dashboard/transactions', [AdminTransaction::class, 'showTransactions'])->name('admin.transactions');
    Route::post('/dashboard/transactions/{transaction}/status', [AdminTransaction::class, 'updateTransactionStatus'])->name('admin.transactions.updateStatus');
    Route::get('/admin/transactions/detail/{id}', [AdminTransaction::class, 'detailIndex'])->name('admin.transaction.detail');
    Route::post('/admin/transactions/add/{id}', [AdminTransaction::class, 'add'])->name('admin.transactions.add');
    Route::get('admin/transactions/{id}/pdf', [AdminTransaction::class, 'exportPdf'])->name('admin.transactions.exportPdf');



  // اضف المنتجات             
});
