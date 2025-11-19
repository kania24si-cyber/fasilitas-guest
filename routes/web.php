<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FasilitasUmumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanFasilitasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;




Route::get('/', function () {
    return view('welcome');
});


Route::get('/fasilitas', [FasilitasUmumController::class, 'index'])
    ->name('fasilitas.index');
route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/dashboard', function () {
    return view('guest.dashboard');
})->name('dashboard');
Route::resource('/warga', WargaController::class);
Route::resource('/peminjaman', PeminjamanFasilitasController::class);


Route::get('/home', function () {
    return view('guest.home');
})->name('home');

Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');


// Setelah login → arahkan ke halaman home
Route::get('/home', function () {
    if (!Auth::check()) {
        return redirect()->route('auth.index');
    }
    return view('guest.home.home'); // ← ini yang berubah
})->name('home');

Route::get('/home', function () {
    if (!Auth::check()) {
        return redirect()->route('auth.index');
    }
    return view('guest.home'); // pastikan file ada di resources/views/guest/home.blade.php
})->name('home');

Route::resource('/users', UserController::class);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::resource('fasilitas', FasilitasUmumController::class);
