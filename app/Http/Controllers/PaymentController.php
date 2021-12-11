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
        $ok = true;
        if(!isset($request->paket)) {
            $ok = false;
        }
        if(!isset($request->jlh_orang)) {
            $ok = false;
        }
        if(!isset($request->durasi)) {
            $ok = false;
        } 

        if(!$ok) {
            return view('sewa1', [
                "packets" => \App\Models\Packet::all(),
            ]);
        }
        
        $paket = $request->paket;
        $jlh_orang = $request->jlh_orang;
        $durasi = $request->durasi;

        $errors = [];  
        $isValid = true;
        if($paket == "none") {   
            $isValid = false;
            $errors['paket'] = 'Pilih salah satu paket.';
            $errors['oldPaket'] = $paket;
        }
        if($jlh_orang == '') {
            $isValid = false;
            $errors['jlh_orang'] = 'Jumlah orang harus diisi.';
        } else {
            $errors['oldJlhOrang'] = $jlh_orang;
        }
        if($durasi == '') {
            $isValid = false;
            $errors['durasi'] = 'Durasi harus diisi';
        } else {
            $errors['oldDurasi'] = $durasi;
        }
        
        if(!$isValid) {
            return redirect()->back()->withErrors($errors);
        }

        $_SESSION['order']['paket'] = $request->paket;
        $_SESSION['order']['jlh_orang'] = $request->jlh_orang;
        $_SESSION['order']['durasi'] = $request->durasi; 
        
        // dd($_SESSION['order']);
        return view('sewa2');
    }

    public function formIdentitas(Request $request) {
        $ok = true;
        if(!isset($request->tanggalsewa)) {
            $ok = false;
        }
        if(!isset($request->waktusewa)) {
            $ok = false;
        }

        if(!$ok) {
            return view('sewa1', [
                "packets" => \App\Models\Packet::all(),
            ]);
        }

        $_SESSION['order']['tanggal'] = date("Y-m-d", strtotime($request->tanggalsewa));
        $_SESSION['order']['waktu'] = $request->waktusewa;
        // $date = date_create($request->tanggalsewa.' '.$request->waktusewa);
        // dd(date_format($date, 'Y/m/d H:i:s'));
        $harga = \App\Models\Packet::firstWhere('packet_id', $_SESSION['order']['paket'])->price;
        $total = $harga * $_SESSION['order']['durasi'] + max(0, $_SESSION['order']['jlh_orang'] - 5)* PaymentController::CHARGE;
        return view('sewa3', [
            'total' => $total,
            'packet' => \App\Models\Packet::find($_SESSION['order']['paket']),
        ]);
    }

    public function getOrderId($data) {
        $id = hash('md5', $data[0].$data[1].$data[2]);
        return $id; 
    }

    public function isAnyNumber($data) {
        $arr = str_split($data); 
        foreach($arr as $b) {
            if(is_numeric($b)) {
                return true;
            }
        }
        return false;
    }

    public function konfirmasi(Request $request) {
        $name = trim($request->name);
        $phone = trim($request->phone);
        $email = trim($request->email);

        $errors = [];
        $isError = false;
        if($name == '') {
            $isError = true;
            $errors['name'] = 'Nama harus diisi.';
        } else if($this->isAnyNumber($name)) {
            $isError = true;
            $errors['name'] = 'Nama harus terdiri dari spasi dan alfabet.'; 
            $errors['oldName'] = $name;
        } else {
            $errors['oldName'] = $name;
        }

        if($phone == '') {
            $isError = true;
            $errors['phone'] = 'No. WhatsApp harus diisi.';
        } else if(!is_numeric($phone)) {
            $isError = true;
            $errors['phone'] = 'No. WhatsApp harus numeric.'; 
            $errors['oldPhone'] = $phone;
        } else {
            $errors['oldPhone'] = $phone;
        }

        if($email == '') {
            $isError = true;
            $errors['email'] = 'Email harus diisi.';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $isError = true;
            $errors['email'] = "Email tidak valid.";
            $errors['oldEmail'] = $email;
        }  else {
            $errors['oldEmail'] = $email;
        }

        if($isError) {
            return redirect()->back()->withErrors($errors);
        } 
        
        $_SESSION['order']['name'] = $name;
        $_SESSION['order']['phone'] = $phone;
        $_SESSION['order']['email'] = $email;

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
            'enabled_payments' => ['indomaret', 'alfamart'],
        );
        
        try {
            $payment_url = \Midtrans\Snap::createTransaction($params)->redirect_url;
            header("Location: $payment_url"); 
        } catch(Exception $e) {
            // Order::where($order['order_id'])->delete();
            return redirect('sewa1')->with('exception', "Maaf, telah terjadi kesalahan. Silahkan coba lagi.");
        }
        $order = $_SESSION['order']; 
        $res = $this->insertToOrders($order);
        if(!$res) {
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
        $order->time = date('Y-m-d H:i', strtotime($data['tanggal'].$data['waktu']));
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
             
            if($notif->transaction_status == 'settlement') {
                $data = [
                    "order_id" => $order_id,
                    "amount" => $notif->gross_amount,
                    "time" => $notif->transaction_time,
                    "status_code" => $status_code,
                ];
                $this->insertToPayments($data);
            }
            \App\Models\Order::where('order_id', $order_id)->update([
                'status' => ucfirst($notif->transaction_status),
            ]);
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