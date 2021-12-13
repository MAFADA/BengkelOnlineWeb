<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cust\CustomerController;
use App\Http\Controllers\Cust\OrderController;
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
    return view('welcome');
});

Auth::routes();

// Route::resource('customer', CustomerController::class);

Route::get('order/{id}',[OrderController::class, 'index'])->name('order.index');

Route::post('order/{id}', [OrderController::class,'order'])->name('order.order');

Route::get('checkout',[OrderController::class,'checkout'])->name('order.checkout');

Route::delete('checkout/{id}',[OrderController::class,'delete'])->name('order.delete');

Route::get('konfirm-checkout', [OrderController::class,'confirm'])->name('order.confirm');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
