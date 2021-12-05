<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use GuzzleHttp\Psr7\Header;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private const MAX_KAPASITAS = 5;
    private const CHARGE = 30000; 

    public function __construct() {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env("SERVER_KEY_MIDTRANS");
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // Start session
        session_start();
        // Set timezone
        date_default_timezone_set('Asia/Jakarta');
    }
    
    public function index(Request $request) {
        if(isset($request->paket)) {
            $_SESSION['order']['paket'] = $request->paket;
        }
        return view('sewa1', [
            "packets" => \App\Models\Packet::all(),
        ]);
    }

    public function formTanggalWaktu(Request $request) {
        $_SESSION['order']['paket'] = $request->paket;
        $_SESSION['order']['jlh_orang'] = $request->jlh_orang;
        $_SESSION['order']['durasi'] = $request->durasi; 
        
        // dd($_SESSION['order']);
        return view('sewa2');
    }

    public function formIdentitas(Request $request) {
        $_SESSION['order']['tanggal'] = date("Y-m-d", strtotime($request->tanggalsewa));
        $_SESSION['order']['waktu'] = $request->waktusewa;
        // $date = date_create($request->tanggalsewa.' '.$request->waktusewa);
        // dd(date_format($date, 'Y/m/d H:i:s'));
        $harga = \App\Models\Packet::firstWhere('packet_id', $_SESSION['order']['paket'])->price;
        $total = $harga * $_SESSION['order']['durasi'] + max(0, $_SESSION['order']['jlh_orang'] - PaymentController::CHARGE);
        return view('sewa3', ['total' => $total,]);
    }

    public function getOrderId($data) {
        $id = hash('md5', $data[0].$data[1].$data[2]);
        return $id; 
    }

    public function konfirmasi(Request $request) {
        $_SESSION['order']['name'] = $request->name;
        $_SESSION['order']['phone'] = $request->phone;
        $_SESSION['order']['email'] = $request->email;

        $jlh_orang = $_SESSION['order']['jlh_orang'];
        $durasi = $_SESSION['order']['durasi'];
        $paket = \App\Models\Packet::firstWhere('packet_id', $_SESSION['order']['paket']);

        $order_id = $this->getOrderId([$_SESSION['order']['paket'], $_SESSION['order']['email'], date('Y-m-d H:i:s +0700')]);
        $_SESSION['order']['id'] = $order_id;

        $transaction_details = array( 
            'order_id' => $order_id,
        );
        
        $customer_details = array(
            'first_name' => $_SESSION['order']['name'],
            'email' => $_SESSION['order']['email'],
            'phone' => $_SESSION['order']['phone'],
        );

        $item_details = array(
            array(
                'id' => $_SESSION['order']['paket'],
                'price' => $paket->price,
                'quantity' => $durasi,
                'name' => $paket->name,
            ),
        );
 
        if($jlh_orang > PaymentController::MAX_KAPASITAS) {
            $item_detail = array(
                'id' => "CHARGE".$_SESSION['order']['paket'],
                'price' => PaymentController::CHARGE,
                'quantity' => $jlh_orang - PaymentController::MAX_KAPASITAS,
                'name' => "Charge",
            );
            array_push($item_details, $item_detail); 
        }

        $batas_pembayaran = array(
            'start_time' => date('Y-m-d H:i:s +0700'),
            'duration' => 1,
            'unit' => "day",
        );

        $params = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details'=> $item_details,
            'expiry' => $batas_pembayaran,
        );
        $order = $_SESSION['order']; 
        $res = $this->insertToOrders($order);
        if(!$res) {
            return redirect('sewa1')->with('exception', "Maaf, telah terjadi kesalahan. Silahkan coba lagi.");
        }
        try {
            $payment_url = \Midtrans\Snap::createTransaction($params)->redirect_url;
            header("Location: $payment_url");  
        } catch(Exception $e) {
            Order::find($order['order_id'])->delete();
            return redirect('sewa1')->with('exception', "Maaf, telah terjadi kesalahan. Silahkan coba lagi.");
        }
        unset($_SESSION['order']);
        exit(0);
    }    

    public function insertToOrders($data) { 
        $order = new \App\Models\Order();
        $order->order_id = $data['id'];
        $order->name = $data['name'];
        $order->phone = $data['phone'];
        $order->email = $data['email'];
        $order->time = date('Y-m-d H:i:s', strtotime($data['tanggal'].$data['waktu']));
        $order->packet_id = $data['paket'];
        $order->duration = $data['durasi'];
        $order->status = "Pending";
        return $order->save();
    }

    public function batal() {
        unset($_SESSION['order']);
        return redirect('/sewa1');
    }

    public function notification() {
        $notif = new \Midtrans\Notification();
        $order_id = $notif->order_id;
        $status_code = $notif->status_code;
        $gross_amount = $notif->gross_amount;
        $signature_key = hash('sha512', $order_id.$status_code.$gross_amount.env('SERVER_KEY_MIDTRANS'));
        
        if($signature_key != $notif->signature_key) {
            // Mungkin ada laporan transaksi ilegal ke pemilik studio
            exit(0);
        } 
 
        // Transaksi akan diproses 
        if(strcmp($status_code, "200") == 0) { // Transaksi pembayaran
            $data = [
                "order_id" => $order_id,
                "amount" => $notif->gross_amount,
                "time" => $notif->transaction_time,
                "status_code" => $status_code,
            ]; 
            $res = $this->insertToPayments($data);
            if($res) {
                \App\Models\Order::where('order_id', $order_id)->update([
                    'status' => 'Paid',
                ]);
            }
        } else if(strcmp($status_code, "201") == 0) { // Transaksi pending 
            \App\Models\Order::where('order_id', $order_id)->update([
                'status' => 'Pending',
            ]);
        } else if(strcmp($status_code, "407") == 0) { // Transaksi expired 
            \App\Models\Order::where('order_id', $order_id)->update([
                'status' => 'Expired',
            ]);
        } else if(strcmp($status_code, "202") == 0) { // Transaksi Denied
            // BELUM MENERIMA REFUND
            // \App\Models\Order::where('order_id', $order_id)->update([
            //     'status' => 'Denied',
            // ]);
        }
    }

    public function insertToPayments($data) {
        $payment = new \App\Models\Payment();
        $payment->order_id = $data['order_id'];
        $payment->amount = $data['amount'];
        $payment->time = $data['time'];
        $payment->status_code = $data['status_code'];
        return $payment->save();
    }
}