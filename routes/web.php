<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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
    return view('/welcome');
});

Route::get('/layanan', function () {
    return view('/layanan');
}); 

Route::get('/sewa1', function () {
    return view('/sewa1');
}); 

Route::get('/sewa2', function () {
    return view('/sewa2');
}); 

Route::get('/sewa3', function () {
    return view('/sewa3');
}); 

// Routes untuk Dashboard dan Orders pada Halaman Admin
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders');
Route::get('/orders/addOrders', [App\Http\Controllers\AdminController::class, 'addOrders'])->name('admin.addOrders');
Route::post('/orders/addOrders/sukses', [App\Http\Controllers\AdminController::class, 'storeOrders'])->name('admin.storeOrders');
Route::get('/orders/hapus/{order_id}', [App\Http\Controllers\AdminController::class, 'deleteOrders'])->name('admin.deleteOrders');