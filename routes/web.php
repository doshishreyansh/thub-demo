<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(ProductController::class)->group(function () {
    Route::get('productList', 'productList');
    Route::get('loadAddProduct', 'loadAddProduct');
    Route::post('product', 'store');
});

Route::get('/', [ProductController::class, 'productList']);
