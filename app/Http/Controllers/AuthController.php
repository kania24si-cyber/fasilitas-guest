<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // =====================
    // HALAMAN LOGIN
    // =====================
    public function index()
    {
        return view('pages.login.login-form');
    }

    // =====================
    // PROSES LOGIN
    // =====================
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan!')->withInput();
        }

        // Cek apakah password yang diinput sesuai dengan password yang di-hash
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau password salah!')->withInput();
        }

        // Login berhasil, proses autentikasi
        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        // Default: guest
        return redirect()->route('about');
    }

    // =====================
    // LOGOUT
    // =====================
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()
            ->route('auth.index')
            ->with('success', 'Anda telah keluar.');
    }
}
