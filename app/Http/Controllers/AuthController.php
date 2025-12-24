<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.login.login-form');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan!')->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau password salah!')->withInput();
        }

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('about');
    }

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
