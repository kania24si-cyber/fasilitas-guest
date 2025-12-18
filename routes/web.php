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
use App\Http\Controllers\DeveloperProfileController;
use App\Http\Controllers\ProfileController;
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
Route::get('/DesaSface', [AboutController::class, 'index'])->name('about');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/developer-profile', [DeveloperProfileController::class, 'show'])->name('profile');
Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');

// Menampilkan form untuk mengedit profil
Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// Mengupdate profil pengguna
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

// Menghapus foto profil
Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
    // Hanya bisa diakses oleh pengguna yang sudah login
    Route::get('petugas', [PetugasFasilitasController::class, 'index'])->name('petugas.index');


    Route::resource('fasilitas', FasilitasUmumController::class)->except(['show']);

    Route::get('pembayaran_fasilitas/create', [PembayaranFasilitasController::class, 'create'])->name('pembayaran_fasilitas.create');
    Route::post('pembayaran_fasilitas', [PembayaranFasilitasController::class, 'store'])->name('pembayaran_fasilitas.store');

    Route::resource('peminjaman', PeminjamanFasilitasController::class)->except(['show']);

   Route::resource('syarat_fasilitas', SyaratFasilitasController::class)->except(['show']);
    // Menampilkan halaman profil pengguna
    Route::middleware([CheckRole::class.':admin'])->group(function () {
  // User
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('/users', UserController::class); 

        // Fasilitas Umum
        Route::get('/fasilitas/{id}', [FasilitasUmumController::class, 'show'])->name('fasilitas.show');
        Route::delete('/fasilitas/media/{id}', [FasilitasUmumController::class, 'deleteMedia'])->name('media.fasilitas.delete');

        // Peminjaman Fasilitas
        Route::get('/peminjaman/{id}', [PeminjamanFasilitasController::class, 'show'])->name('peminjaman.show');
        Route::delete('/peminjaman/media/{id}', [PeminjamanFasilitasController::class, 'deleteMedia'])->name('media.peminjaman.delete');

        // Syarat Fasilitas
        Route::get('/syarat_fasilitas/{id}', [SyaratFasilitasController::class, 'show'])->name('syarat_fasilitas.show');
        Route::delete('/syarat_fasilitas/{delete}', [SyaratFasilitasController::class, 'destroy'])->name('syarat_fasilitas.destroy');

    // Pembayaran Fasilitas
        Route::get('pembayaran_fasilitas', [PembayaranFasilitasController::class, 'index'])->name('pembayaran_fasilitas.index');
        Route::get('pembayaran_fasilitas/{id}/edit', [PembayaranFasilitasController::class, 'edit'])->name('pembayaran_fasilitas.edit');
        Route::put('pembayaran_fasilitas/{id}', [PembayaranFasilitasController::class, 'update'])->name('pembayaran_fasilitas.update');
        // Route untuk Show
        Route::get('pembayaran_fasilitas/{id}', [PembayaranFasilitasController::class, 'show'])->name('pembayaran_fasilitas.show');
        // Route untuk Destroy (Hapus Data)
        Route::delete('pembayaran_fasilitas/{id}', [PembayaranFasilitasController::class, 'destroy'])->name('pembayaran_fasilitas.destroy');

   // Petugas Fasilitas
        Route::get('petugas/create', [PetugasFasilitasController::class, 'create'])->name('petugas.create');
        Route::post('petugas', [PetugasFasilitasController::class, 'store'])->name('petugas.store');
        Route::get('petugas/{id}/edit', [PetugasFasilitasController::class, 'edit'])->name('petugas.edit');
        Route::put('petugas/{id}', [PetugasFasilitasController::class, 'update'])->name('petugas.update');
        Route::get('petugas/{id}', [PetugasFasilitasController::class, 'show'])->name('petugas.show');
        Route::delete('petugas/{id}', [PetugasFasilitasController::class, 'destroy'])->name('petugas.destroy');

         // Warga
    Route::resource('warga', WargaController::class)->except(['show']);
    Route::get('/warga/{id}', [WargaController::class, 'show'])->name('warga.show');
    Route::delete('/warga/{delete}', [WargaController::class, 'destroy'])->name('warga.destroy');

    // Pembayaran Fasilitas

});
});
/*
|---------------------------------------------------------------------------|
| ROUTES FOR GUEST (Non-Admin)
|---------------------------------------------------------------------------|
*/


