<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
 public function index() 
 {
    return view('login-form');
 }

 public function login(Request $request) 
 {
   $request->validate([
    'username' => 'required',
    'password' => [
        'required',
        'min:3',
        'regex:/[A-Z]/' 
    ],
], [
    'username.required' => 'Username wajib diisi',
    'password.required' => 'Password wajib diisi',
    'password.min' => 'Password minimal 3 karakter.',
    'password.regex' => 'Password harus mengandung huruf kapital']);

if ($request->username === $request->password) {
    return view('login-success', ['username' => $request->username]);
}
return redirect()->back()->with('error', 'Username atau password tidak sama!');
 }
}
