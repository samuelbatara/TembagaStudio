<?php

namespace App\Http\Controllers;

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
        $id = hash('md5', $data[0].$data[1]);
        return $id; 
    }

    public function konfirmasi(Request $request) {
        $_SESSION['order']['name'] = $request->name;
        $_SESSION['order']['phone'] = $request->phone;
        $_SESSION['order']['email'] = $request->email;
        
        $jlh_orang = $_SESSION['order']['jlh_orang'];
        $durasi = $_SESSION['order']['durasi'];
        $paket = \App\Models\Packet::firstWhere('packet_id', $_SESSION['order']['paket']);
        $transaction_details = array( 
            'order_id' => $this->getOrderId([$_SESSION['order']['paket'], $_SESSION['order']['email'], date('Y-m-d H:i:s +0700')]),
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
        unset($_SESSION['order']);
        try {
            $payment_url = \Midtrans\Snap::createTransaction($params)->redirect_url;
            header("Location: $payment_url"); 
            exit(0);
        } catch(Exception $e) {
            return redirect('sewa1')->with('exception', "Maaf, telah terjadi kesalahan. Silahkan coba lagi.");
        }
    }    

    public function batal() {
        unset($_SESSION['order']);
        return redirect('/sewa1');
    }
}