<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopifyController;
use App\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['verify.shopify'])->group(function () {
    Route::get('/', [ShopifyController::class,'dashboard'])->name('home');
    //Route::get('/authenticate', [AuthenticationController::class,'authenticate'])->name('authenticate');
});
Route::get('/dashboard', [ShopifyController::class,'dashboard'])->name('dashboard');
Route::get('/products', [ShopifyController::class,'index'])->name('products');
Route::post('/products/alert', [ShopifyController::class,'store'])->name('products.store');
Route::get('/products/{product_id}/alert', [ShopifyController::class,'editAlert'])->name('products.alert.form');