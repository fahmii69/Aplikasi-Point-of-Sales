<?php

use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\SupplierController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/supplier/get', [SupplierController::class, 'getSupplier'])->name('supplier.list');
Route::resource('supplier', SupplierController::class);

Route::get('/product/get', [ProductController::class, 'getProduct'])->name('product.list');
Route::get('/product/getModifier/{id}', [ProductController::class, 'getModifier'])->name('product.getModifier');
Route::resource('product', ProductController::class);
