<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\FasilitasUmumController;
use App\Http\Controllers\PeminjamanFasilitasController;
use App\Http\Controllers\WargaController;

/*
|--------------------------------------------------------------------------
| AUTH (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

/*
|--------------------------------------------------------------------------
| WAJIB LOGIN + CEK ROLE
|--------------------------------------------------------------------------
|
| checkislogin  → memastikan user sudah login
| checkrole:User → memastikan role = 'User'
|
| Setelah login, user bisa masuk dashboard, home, about, dan semua fitur lainnya.
|--------------------------------------------------------------------------
*/

Route::middleware(['checkislogin', 'checkrole:Guest'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // About
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    /*
    |--------------------------------------------------------------------------
    | USERS (TIDAK DIHAPUS)
    |--------------------------------------------------------------------------
    */
    Route::resource('/users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | FASILITAS (TIDAK DIHAPUS)
    |--------------------------------------------------------------------------
    */
    Route::resource('fasilitas', FasilitasUmumController::class);
    Route::get('/fasilitas/{id}', [FasilitasUmumController::class, 'show'])->name('fasilitas.show');
    Route::get('/fasilitas/create', [FasilitasUmumController::class, 'create'])->name('fasilitas.create');
    Route::post('/fasilitas', [FasilitasUmumController::class, 'store'])->name('fasilitas.store');
    Route::delete('/media/{id}', [FasilitasUmumController::class, 'deleteMedia'])->name('media.delete');

    /*
    |--------------------------------------------------------------------------
    | PEMINJAMAN (TIDAK DIHAPUS)
    |--------------------------------------------------------------------------
    */
    Route::resource('/peminjaman', PeminjamanFasilitasController::class);
    Route::get('/peminjaman/{id}', [PeminjamanFasilitasController::class, 'show'])->name('peminjaman.show');
    Route::put('/peminjaman/{id}', [PeminjamanFasilitasController::class, 'update'])->name('peminjaman.update');
    Route::post('/peminjaman', [PeminjamanFasilitasController::class, 'store'])->name('peminjaman.store');
    Route::delete('/media/{id}', [PeminjamanFasilitasController::class, 'deleteMedia'])->name('media.delete');

    /*
    |--------------------------------------------------------------------------
    | WARGA
    |--------------------------------------------------------------------------
    */
    Route::resource('/warga', WargaController::class);
});
