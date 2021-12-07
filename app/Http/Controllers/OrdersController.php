<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
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
