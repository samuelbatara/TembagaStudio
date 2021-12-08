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
 
Route::get('/layanan', function () {
    return view('/layanan');
}); 

// Route::get('/sewa1', function () {
//     return view('/sewa1');
// }); 

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);   

// Routes untuk Dashboard dan Orders pada Halaman Admin
Route::group(['middleware'=>'revalidate'], function() {
    Route::group(['middleware'=>'auth:admin'], function() {
        // Routed dashboard
        Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

        // Routes Order
        Route::get('/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders');
        Route::get('/addOrders', [App\Http\Controllers\AdminController::class, 'addOrders'])->name('admin.addOrders');
        Route::post('/addOrders', [App\Http\Controllers\AdminController::class, 'storeOrders'])->name('admin.storeOrders');
        Route::get('/orders/hapus/{order_id}', [App\Http\Controllers\AdminController::class, 'deleteOrders'])->name('admin.deleteOrders');
        Route::get('/orders/editOrders/{order_id}', [App\Http\Controllers\AdminController::class, 'editOrders'])->name('admin.editOrders');
        Route::post('/orders/update', [App\Http\Controllers\AdminController::class, 'updateOrders'])->name('admin.updateOrders');
        Route::get('/orders/{order_id}', [App\Http\Controllers\AdminController::class, 'infoOrder'])->name('admin.infoOrder'); 
        Route::get('/cancel/{order_id}', [App\Http\Controllers\AdminController::class, 'cancelOrder'])->name('admin.cancel');
        Route::get('/status', [App\Http\Controllers\AdminController::class, 'ordersByStatus'])->name('admin.status');


        // Routes Paket
        Route::get('/packets', [App\Http\Controllers\AdminController::class, 'packets'])->name('admin.packet');
        Route::get('/packets/addPackets', [App\Http\Controllers\AdminController::class, 'addPackets'])->name('admin.addPackets');
        Route::post('/packets/addPackets/sukses', [App\Http\Controllers\AdminController::class, 'storePackets'])->name('admin.storePackets');
        Route::get('/packets/hapus/{packet_id}', [App\Http\Controllers\AdminController::class, 'deletePackets'])->name('admin.deletePackets');
        Route::get('/packets/editPackets/{packet_id}', [App\Http\Controllers\AdminController::class, 'editPackets'])->name('admin.editPackets');
        Route::post('/packets/update', [App\Http\Controllers\AdminController::class, 'updatePackets'])->name('admin.updatePackets');
    });


    // Proses penyewaan
    Route::get('/sewa1', [\App\Http\Controllers\PaymentController::class, 'index']);
    Route::get('/sewa2', [\App\Http\Controllers\PaymentController::class, 'formTanggalWaktu']); 
    Route::get('/sewa3', [\App\Http\Controllers\PaymentController::class, 'formIdentitas']); 
    Route::get('/konfirmasi', [\App\Http\Controllers\PaymentController::class, 'konfirmasi']);

    // Login untuk admin
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'formLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
});

// Notifikasi dari Midtrans (Don't touch)
Route::post('/notification', [App\Http\Controllers\PaymentController::class, 'notification']);
Route::get('/finish', [\App\Http\Controllers\HomeController::class, 'finish']);
Route::get('/unfinish', [\App\Http\Controllers\HomeController::class, 'unfinish']);
Route::get('/batal', [\App\Http\Controllers\PaymentController::class, 'batal']);
Route::get('/error', [\App\Http\Controllers\HomeController::class, 'error']);