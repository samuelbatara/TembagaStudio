<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Http\Controllers\OrdersController;
use App\Models\Payment;

use function PHPSTORM_META\map;

// Class untuk Admin
class AdminController extends Controller
{
    
    public function __construct()
    {   // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env("SERVER_KEY_MIDTRANS");
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $this->middleware('auth:admin');
        date_default_timezone_set('Asia/Jakarta');
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
                    ->where('status', '=', 'pending')
                    ->count();
        // Menghitung Jumlah Orders dengan status Paid
        $settlement =  DB::table('orders')
                    ->where('status', '=', 'settlement')
                    ->count();
        $cancel =  DB::table('orders')
                ->where('status', '=', 'cancel')
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
            "settlement" => $settlement,
            "cancel" => $cancel,
            "paket" => Packet::pluck('name', 'packet_id'),
        ]);


    }

    public function cancelOrder($order_id) {
        $cancel = \Midtrans\Transaction::cancel($order_id);
        return $this->orders();
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

    public function ordersByStatus(Request $request) {
        $packets = array();
        foreach(Packet::all() as $item) {
            $packets[$item->packet_id] = $item->name;
        } 
        $orders = new OrdersController(); 
        return view('admin.orders',[
            "title" => "Orders", 
            "orders" => $orders->getOrdersByStatus($request->status),
            "packets" => $packets,
        ]);
    }

    public function infoOrder($order_id) {

        $T = \Midtrans\Transaction::status($order_id);
        $data = [];
        foreach($T as $key => $value) {
            $data[$key] = $value;
        }  
        $orders = new OrdersController(); 
        $order = $orders->getIf($order_id)[0];
        $packet = Packet::find($order->packet_id);
        $payment = Payment::firstWhere('order_id', $order_id); 
        $jlh_orang = ($data['gross_amount'] - $order->duration * $packet->price) / 30000; 
        $store = ($data['store']=='indomaret')? 'Indomaret' : 'Alfamaret';
        return view('admin.infoOrder', [
            'title'=>'Tembaga Studio - Detail Order',
            'packet' => $packet,
            'order' => $order,
            'payment' => $payment,
            'amount' => $data['gross_amount'],
            'jlh_orang' => $jlh_orang,
            'payment_code' => $data['payment_code'],
            'store' => $store,
        ]);
    }

    public function addOrders()
    {
        return view("admin.addOrders", [
            "title" => "Tambah Orders",
            "Paket" => Packet::all(),
        ]);
    }

    public function getOrderId($data) {
        $id = hash('md5', $data[0].$data[1].$data[2]);
        return $id; 
    }

    public function storeOrders(Request $request)
    {
        $order_id = $this->getOrderId([$request->packet_id, $request->email, date('Y-m-d H:i:s +0700')]);
        
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email:rfc,dns',
            'time' => 'required',
            'packet_id' => 'required',
            'jlh_orang' => 'required|min:1',
            'duration' => 'required|min:1',
            'status' => 'required',
        ],$messages);
         
        if(strcmp('none', $request->packet_id) == 0 && strcmp('none', $request->status) == 0) {
            return back()->with([
                'packet_id'=>'Pilih salah satu paket yang tersedia',
                'status' => 'Pilih status pembayaran',
            ]);
        } else if(strcmp('none', $request->packet_id) == 0) {
            return back()->with('packet_id', 'Pilih salah satu paket yang tersedia');
        } else if(strcmp('none', $request->status) == 0) {
            return back()->with('status', 'Pilih status pembayaran');
        }

        // Cara Primitive
        // DB::table('orders')->insert([
        //     'order_id' => $order_id,
        //     'name' => $request->name,
        //     'phone' => $request->phone,
        //     'email' => $request->email,
        //     'time' => date('Y-m-d H:i', strtotime($request->time)),
        //     'packet_id' => $request->packet_id,
        //     'jlh_orang' => $request->jlh_orang,
        //     'duration' => $request->duration,
        //     'status' => $request->status,
        // ]);

        // Cara menyimpan dengan Eloquent 
        $order = new Order();
        $order->order_id = $order_id;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->time = date('Y-m-d H:i', strtotime($request->time));
        $order->packet_id = $request->packet_id;
        //$order->jlh_orang = $request->jlh_orang;
        $order->duration = $request->duration;
        $order->status = $request->status;
        if($order->save()) {
            $price = (int)Packet::find($request->packet_id)->price; 
            $durasi = (int)$request->duration;
            $jlh_orang = (int)$request->jlh_orang;
            // dd([$price, $durasi, $jlh_orang]);
            $total = $durasi * $price + max(0, $jlh_orang - 5) * 30000;

            if($this->storePayment([$order_id, $total])) {
                return redirect('/orders')->with('success', 'New Orders has been added');
            } else {
                Order::where('order_id', $order_id)->delete();
            }
        }
        return redirect('/orders')->with('error', 'Failed'); 
    }

    public function  storePayment($data) {
        $payment = new Payment();
        $payment->order_id = $data[0];
        $payment->status_code = 200;
        $payment->amount = $data[1];
        $payment->time = date('Y-m-d H:i');
        return $payment->save();
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
