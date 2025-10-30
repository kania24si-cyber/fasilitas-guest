<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        // Langsung tampilkan halaman home (tanpa cek login)
        return view('pages.home.home');
    }
}
