<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Memanggil resources/views/auth/login.blade.php
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        // Validasi menggunakan 'username' (bukan email)
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Mengarah ke rute bernama 'admin.dashboard'
            return redirect()->route('admin.dashboard');
        }

        // Jika gagal, kembali dengan input username lama
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}