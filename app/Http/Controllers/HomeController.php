<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        return view('welcome');
    }

    public function finish(Request $request) {
        return redirect('/')->with('success', 'Pesanan Anda Berhasil. Silahkan Menyelesaikan Pembayaran.');
    }

    public function unfinish(Request $request) {
        return redirect('/')->with('info', 'Pesanan Anda belum Selesai.');
    }

    public function error(Request $request) {
        return redirect('/')->with('error', 'Pesanan Anda gagal.');
    }
}
