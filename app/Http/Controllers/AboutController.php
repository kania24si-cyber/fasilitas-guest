<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // arahkan ke folder guest/about/About.blade.php
        return view('pages.about.About');
    }
}
