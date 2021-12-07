<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{   
    public function __construct()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env("SERVER_KEY_MIDTRANS");
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    private $table = "orders";
    public function all() { 
        $orders = DB::select("SELECT * FROM $this->table");
        return $orders;
    } 

    public function getIf($order_id) {
        $order = DB::select("SELECT * FROM $this->table WHERE order_id='$order_id' LIMIT 1");
        return $order;
    }
}
