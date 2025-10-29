<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Halaman login
    public function index()
    {
        return view('guest.login.login-form');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Ambil user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Kalau email tidak ditemukan
        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan!')->withInput();
        }

        // Cek password terenkripsi
        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('home');
        }

        // Kalau gagal login
        return back()->with('error', 'Email atau password salah!')->withInput();
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.index')->with('success', 'Anda telah keluar.');
    }
}
