<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use App\Models\Studios;
use Illuminate\Http\Request;
// Class untuk Admin
class AdminController extends Controller
{
    // Method Untuk Pemanggilan Halaman Dashboard
    public function index()
    {
        return view('admin.dashboard',[
            "title" => "Dashboard",
            "nama" => "Admin"
        ]);
    }
    // Method Untuk Pemanggilan Halaman Orders
    public function orders()
    {
        return view('admin.orders',[
            "title" => "Orders",
            "nama" => "Admin",
            "allOrders" => Orders::all(),
        ]);
    }

    public function addOrders()
    {
        return view("admin.addOrders", [
            "title" => "Tambah Orders",
            "studios" => Studios::pluck('name', 'studio_id'),
        ]);
    }

    public function storeOrders(Request $request)
    {

        Orders::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'time' => $request->time,
            'studio_id' => $request->studio_id,
            'duration' => $request->duration,
            'status' => $request->status,
        ]);

        return redirect('/orders')->with('success', 'New Orders has been added');
    }

    public function deleteOrders($o)
    {
        Orders::where('order_id', $o)->delete();
        return redirect('/orders')->with('error', 'Member has been removed');
    }

    public function logout(){
        return redirect(route('/'));
    }
}
