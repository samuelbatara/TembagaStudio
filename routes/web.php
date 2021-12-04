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

// Routes untuk Dashboard dan Orders pada Halaman Admin
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

// Routes Order
Route::get('/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders');
Route::get('/orders/addOrders', [App\Http\Controllers\AdminController::class, 'addOrders'])->name('admin.addOrders');
Route::post('/orders/addOrders/sukses', [App\Http\Controllers\AdminController::class, 'storeOrders'])->name('admin.storeOrders');
Route::get('/orders/hapus/{order_id}', [App\Http\Controllers\AdminController::class, 'deleteOrders'])->name('admin.deleteOrders');
Route::get('/orders/editOrders/{order_id}', [App\Http\Controllers\AdminController::class, 'editOrders'])->name('admin.editOrders');
Route::post('/orders/update', [App\Http\Controllers\AdminController::class, 'updateOrders'])->name('admin.updateOrders');

// Routes Order
Route::get('/packets', [App\Http\Controllers\AdminController::class, 'packets'])->name('admin.packet');
Route::get('/packets/addPackets', [App\Http\Controllers\AdminController::class, 'addPackets'])->name('admin.addPackets');
Route::post('/packets/addPackets/sukses', [App\Http\Controllers\AdminController::class, 'storePackets'])->name('admin.storePackets');
Route::get('/packets/hapus/{packet_id}', [App\Http\Controllers\AdminController::class, 'deletePackets'])->name('admin.deletePackets');
Route::get('/packets/editPackets/{packet_id}', [App\Http\Controllers\AdminController::class, 'editPackets'])->name('admin.editPackets');
Route::post('/packets/update', [App\Http\Controllers\AdminController::class, 'updatePackets'])->name('admin.updatePackets');