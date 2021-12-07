<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Http\Controllers\OrdersController;
use Symfony\Contracts\Service\Attribute\Required;

// Class untuk Admin
class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Method Untuk Pemanggilan Halaman Dashboard
    public function index(Request $request)
    {
        // Menghitung SUM amounts dalam table payment
        $sum = DB::table('payments')
            ->sum("amount");
        // Menghitung SUM amounts dengan packet id 1
        $sum1 = DB::table('payments')
                ->join('orders', 'payments.order_id', '=', 'orders.order_id')
                ->where('orders.packet_id', '=', 1)
                ->sum('payments.amount');
        // Menghitung SUM amounts dengan packet id 2
        $sum2 = DB::table('payments')
                ->join('orders', 'payments.order_id', '=', 'orders.order_id')
                ->where('orders.packet_id', '=', 2)
                ->sum('payments.amount');
        // Menghitung Jumlah Orders
        $corder = DB::table('orders')->count();
        // Menghitung Jumlah Orders dengan status Not Paid
        $pending =  DB::table('orders')
                    ->where('status', '=', 'Not Paid')
                    ->count();
        // Menghitung Jumlah Orders dengan status Paid
        $paid =  DB::table('orders')
                    ->where('status', '=', 'Paid')
                    ->count();
       
        // Return View Admin Dashboard dengan membuat variable panggilan untuk blade
        return view('admin.dashboard',[
            "title" => "Dashboard",
            "nama" => "Admin",
            "sum" => $sum,
            "sumpacket1" => $sum1,
            "sumpacket2" => $sum2,
            "countorder" => $corder,
            "pending" => $pending,
            "paid" => $paid,
            "paket" => Packet::pluck('name', 'packet_id'),
        ]);


    }

    // Method Untuk Pemanggilan Halaman Orders
    public function orders()
    {
        $packets = array();
        foreach(Packet::all() as $item) {
            $packets[$item->packet_id] = $item->name;
        } 
        $orders = new OrdersController(); 
        return view('admin.orders',[
            "title" => "Orders", 
            "orders" => $orders->all(),
            "packets" => $packets,
        ]);
    }

    public function infoOrder($order_id) {
        $orders = new OrdersController(); 
        return view('admin.infoOrder', [
            'title'=>'Tembaga Studio - Detail Order',
            'packets' => Packet::all(),
            'order' => $orders->getIf($order_id)[0],
        ]);
    }

    public function addOrders()
    {
        return view("admin.addOrders", [
            "title" => "Tambah Orders",
            "Paket" => Packet::pluck('name', 'packet_id'),
        ]);
    }

    public function storeOrders(Request $request)
    {
        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $string = substr(str_shuffle(str_repeat($pool, 5)), 0, 5);
        
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request,[
            'name' => 'required|min:5|max:30',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'time' => 'required',
            'packet_id' => 'required',
            'duration' => 'required|min:1',
            'status' => 'required',
        ],$messages);
        
        DB::table('orders')->insert([
            'order_id' => $string,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'time' => $request->time,
            'packet_id' => $request->packet_id,
            'duration' => $request->duration,
            'status' => $request->status,
        ]);

        return redirect('/orders')->with('success', 'New Orders has been added');
    }

    public function editOrders($order_id)
    {   
        $order = new OrdersController();
        // dd([$order_id, $order->getIf($order_id)]);
        return view('admin.editOrders', [
            "title" => "Edit Order",
            'editOrders' => $order->getIf($order_id), 
            "packets" => Packet::all(),
        ]);
    }

    public function updateOrders(Request $request)
    {
        $messages = [
            'required' => ':attribute harus diisi ',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
            'email' => ':attribute harus dalam bentuk email, misal: example@example.com',
        ]; 

        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email:rfc,dns',
            'tanggal' => 'required',
            'waktu' => 'required',
            'packet_id' => 'required',
            'duration' => 'required|min:1',
            'status' => 'required',
        ],$messages);  

        Order::where('order_id', $request->order_id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'time' => date('Y-m-d H:i', strtotime($request->tanggal.$request->waktu)),
            'packet_id' => $request->packet_id,
            'duration' => $request->duration,
            'status' => $request->status,
        ]);

        return redirect('/orders')->with('info', 'Order has been changed');
    }

    public function deleteOrders($n)
    {
        Order::where('order_id', $n)->delete();
        return redirect('/orders')->with('error', 'Member has been removed');
    }


    // Packet
    public function packets()
    {
        return view('admin.packet',[
            "title" => "Packet",
            "nama" => "Admin",
            "allPacket" => Packet::all(),
            "Paket" => Packet::pluck('name', 'packet_id'),
        ]);
    }

    public function addPackets()
    {
        return view("admin.addPacket", [
            "title" => "Tambah Paket",
            "Paket" => Packet::pluck('name', 'packet_id'),
        ]);
    }

    public function storePackets(Request $request)
    {
        
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
        ];

        $this->validate($request,[
            'name' => 'required|min:5|max:30',
            'price' => 'required|numeric',
        ],$messages);
        
        DB::table('packets')->insert([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect('/packets')->with('success', 'New Packets has been added');
    }


    public function editPackets($packet_id)
    {
        $edit_packet = Packet::where('packet_id', $packet_id)->get();

        return view('admin.editPacket', [
            "title" => "Edit Paket",
            'editPacket' => $edit_packet,
        ]);
    }

    public function updatePackets(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
        ];

        $this->validate($request,[
            'name' => 'required|min:5|max:30',
            'price' => 'required|numeric',
        ],$messages);

        Packet::where('packet_id', $request->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            // 'update_at' => false,
        ]);
        return redirect('/packets')->with('info', 'Paket has been changed');
    }


    public function deletePackets($n)
    {
        Packet::where('packet_id', $n)->delete();
        return redirect('/packets')->with('error', 'Paket has been removed');
    }
    public function logout(){
        return redirect(route('/'));
    }
}
