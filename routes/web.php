<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FasilitasUmumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanFasilitasController;
use App\Http\Controllers\WargaController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/fasilitas', [FasilitasUmumController::class, 'index']);
route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/dashboard', function () {
    return view('guest.dashboard');
})->name('dashboard');
Route::resource('/warga', WargaController::class);
Route::resource('/peminjaman', PeminjamanFasilitasController::class);