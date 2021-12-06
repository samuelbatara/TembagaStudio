<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout'); 
    } 

    public function formLogin() {
        // dd(Auth::guest());
        return view('login');
    }

    public function login(Request $request) {
        // dd([$request->email, $request->password]);
        if(Auth::guard('admin')->attempt(['email'=>$request->email, "password" => $request->password])) {
            return redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->back()->withInput(['error'=>'Email atau Password salah!']);
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }
}
