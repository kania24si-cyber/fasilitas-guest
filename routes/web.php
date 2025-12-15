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
use App\Http\Controllers\PetugasFasilitasController;
use App\Http\Controllers\SyaratFasilitasController;
use App\Http\Controllers\PembayaranFasilitasController;
use App\Http\Middleware\CheckRole;

/*
|---------------------------------------------------------------------------|
| AUTH (PUBLIC)
|---------------------------------------------------------------------------|
*/

Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
// Rute logout harus menggunakan metode POST
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
  // Ganti GET dengan POST

/*
|---------------------------------------------------------------------------|
| PUBLIC ROUTES
|---------------------------------------------------------------------------|
| Routes untuk Guest (yang belum login)
|---------------------------------------------------------------------------|
*/

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');


/*
|---------------------------------------------------------------------------|
| PROTECTED ROUTES (AUTHENTICATION AND ROLE BASED ACCESS)
|---------------------------------------------------------------------------|
*/

/*
|---------------------------------------------------------------------------|
| ROUTES FOR ADMIN (WITH ROLE CHECK)
|---------------------------------------------------------------------------|
*/
Route::middleware('auth')->group(function () {
   Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Hanya bisa diakses oleh pengguna yang sudah login
    Route::get('petugas', [PetugasFasilitasController::class, 'index'])->name('petugas.index');
    Route::get('/fasilitas', [FasilitasUmumController::class, 'index'])->name('fasilitas.index');
    Route::get('/pembayaran_fasilitas', [PembayaranFasilitasController::class, 'index'])->name('pembayaran_fasilitas.index');
    Route::get('pembayaran_fasilitas/create', [PembayaranFasilitasController::class, 'create'])->name('pembayaran_fasilitas.create');
    Route::post('pembayaran_fasilitas', [PembayaranFasilitasController::class, 'store'])->name('pembayaran_fasilitas.store');
    Route::get('/peminjaman', [PeminjamanFasilitasController::class, 'index'])->name('peminjaman.index');
    Route::get('/syarat_fasilitas', [SyaratFasilitasController::class, 'index'])->name('syarat_fasilitas.index');

Route::middleware([CheckRole::class.':admin'])->group(function () {
  // User
        Route::resource('/users', UserController::class); 

        // Fasilitas Umum
        Route::resource('fasilitas', FasilitasUmumController::class)->except(['show']);
        Route::get('/fasilitas/{id}', [FasilitasUmumController::class, 'show'])->name('fasilitas.show');
        Route::delete('/fasilitas/media/{id}', [FasilitasUmumController::class, 'deleteMedia'])->name('media.fasilitas.delete');

        // Peminjaman Fasilitas
        Route::resource('peminjaman', PeminjamanFasilitasController::class)->except(['show']);
        Route::get('/peminjaman/{id}', [PeminjamanFasilitasController::class, 'show'])->name('peminjaman.show');
        Route::delete('/peminjaman/media/{id}', [PeminjamanFasilitasController::class, 'deleteMedia'])->name('media.peminjaman.delete');

        // Syarat Fasilitas
        Route::resource('syarat_fasilitas', SyaratFasilitasController::class)->except(['show']);
        Route::get('/syarat_fasilitas/{id}', [SyaratFasilitasController::class, 'show'])->name('syarat_fasilitas.show');
        Route::delete('/syarat_fasilitas/{delete}', [SyaratFasilitasController::class, 'destroy'])->name('syarat_fasilitas.destroy');

    // Pembayaran Fasilitas
        Route::get('pembayaran_fasilitas/{id}/edit', [PembayaranFasilitasController::class, 'edit'])->name('pembayaran_fasilitas.edit');
        Route::put('pembayaran_fasilitas/{id}', [PembayaranFasilitasController::class, 'update'])->name('pembayaran_fasilitas.update');
        // Route untuk Show
        Route::get('pembayaran_fasilitas/{id}', [PembayaranFasilitasController::class, 'show'])->name('pembayaran_fasilitas.show');
        // Route untuk Destroy (Hapus Data)
        Route::delete('pembayaran_fasilitas/{id}', [PembayaranFasilitasController::class, 'destroy'])->name('pembayaran_fasilitas.destroy');

   // Petugas Fasilitas
        Route::get('petugas', [PetugasFasilitasController::class, 'index'])->name('petugas.index');
        Route::get('petugas/create', [PetugasFasilitasController::class, 'create'])->name('petugas.create');
        Route::post('petugas', [PetugasFasilitasController::class, 'store'])->name('petugas.store');
        Route::get('petugas/{id}/edit', [PetugasFasilitasController::class, 'edit'])->name('petugas.edit');
        Route::put('petugas/{id}', [PetugasFasilitasController::class, 'update'])->name('petugas.update');
        Route::get('petugas/{id}', [PetugasFasilitasController::class, 'show'])->name('petugas.show');
        Route::delete('petugas/{id}', [PetugasFasilitasController::class, 'destroy'])->name('petugas.destroy');

         // Warga
    Route::get('warga', [WargaController::class, 'index'])->name('warga.index');
    Route::get('warga/create', [WargaController::class, 'create'])->name('warga.create');
    Route::get('warga/edit', [WargaController::class, 'edit'])->name('warga.edit');
    Route::post('warga/store', [WargaController::class, 'store'])->name('warga.store');
});
});
/*
|---------------------------------------------------------------------------|
| ROUTES FOR GUEST (Non-Admin)
|---------------------------------------------------------------------------|
*/


