<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //tampil halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    //proses data login
    public function login(Request $request)
    {
        //validasi data login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //coba login
        if (Auth::attempt($credentials) ){
            //jika berhasil tampil dashboard
            return redirect()->intended('/dashboard');
        } else {
            //jika gagal kembali halaman login
            return redirect()->back()->withErrors(['login' => 'Email atau password salah. !'])->withInput($request->only('email'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
