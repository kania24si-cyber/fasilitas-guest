<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FasilitasUmumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/fasilitas', [FasilitasUmumController::class, 'index']);
route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');