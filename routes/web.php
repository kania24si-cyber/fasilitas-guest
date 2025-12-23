<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasUmumController;
use App\Http\Controllers\SyaratFasilitasController;
use App\Http\Controllers\DeveloperProfileController;
use App\Http\Controllers\PetugasFasilitasController;
use App\Http\Controllers\PembayaranFasilitasController;
use App\Http\Controllers\PeminjamanFasilitasController;
/*
|---------------------------------------------------------------------------|
| AUTH (PUBLIC)
|---------------------------------------------------------------------------|
*/

Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::get('/login', [AuthController::class, 'index'])->name('login'); // Tambahkan rute ini untuk menampilkan halaman login
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
Route::get('', [AboutController::class, 'index'])->name('about');
Route::get('/developer-profile', [DeveloperProfileController::class, 'show'])->name('profile');
Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');

// Menampilkan form untuk mengedit profil
Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// Mengupdate profil pengguna
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

// Menghapus foto profil
Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/whatsapp', [WhatsAppController::class, 'generateLink'])->name('whatsapp.link');
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
    Route::get('petugas/{id}', [PetugasFasilitasController::class, 'show'])->name('petugas.show');

    Route::resource('fasilitas', FasilitasUmumController::class)->except(['show']);

    Route::get('pembayaran_fasilitas/create', [PembayaranFasilitasController::class, 'create'])->name('pembayaran_fasilitas.create');
    Route::post('pembayaran_fasilitas', [PembayaranFasilitasController::class, 'store'])->name('pembayaran_fasilitas.store');
    Route::get('pembayaran_fasilitas', [PembayaranFasilitasController::class, 'index'])->name('pembayaran_fasilitas.index');
    Route::get('pembayaran_fasilitas/{id}', [PembayaranFasilitasController::class, 'show'])->name('pembayaran_fasilitas.show');

    Route::get('peminjaman/create', [PeminjamanFasilitasController::class, 'create'])->name('peminjaman.create');
    Route::post('peminjaman', [PeminjamanFasilitasController::class, 'store'])->name('peminjaman.store');
    Route::get('peminjaman', [PeminjamanFasilitasController::class, 'index'])->name('peminjaman.index');
    Route::get('peminjaman/{id}/edit', [PeminjamanFasilitasController::class, 'edit'])->name('peminjaman.edit');
    Route::put('peminjaman/{id}', [PeminjamanFasilitasController::class, 'update'])->name('peminjaman.update');

    Route::post('syarat_fasilitas', [SyaratFasilitasController::class, 'store'])->name('syarat_fasilitas.store');
    Route::get('syarat_fasilitas', [SyaratFasilitasController::class, 'index'])->name('syarat_fasilitas.index');
    Route::get('syarat_fasilitas/{id}', [SyaratFasilitasController::class, 'show'])->name('syarat_fasilitas.show');
    // Menampilkan halaman profil pengguna
  
    Route::middleware([CheckRole::class.':admin'])->group(function () {

      Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //users
      Route::get('/users', [UserController::class, 'index'])->name('users.index'); // List all users
      Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Show the form to create a new user
      Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Store the new user in the database
      Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show'); // Show a specific user
      Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit'); // Show the form to edit an existing user
      Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update'); // Update an existing user in the database
      Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // Delete a user


        // Fasilitas Umum
        Route::get('/fasilitas/{id}', [FasilitasUmumController::class, 'show'])->name('fasilitas.show');
        Route::delete('/fasilitas/media/{id}', [FasilitasUmumController::class, 'deleteMedia'])->name('media.fasilitas.delete');

        // Peminjaman Fasilitas
      Route::delete('peminjaman/{id}', [PeminjamanFasilitasController::class, 'destroy'])->name('peminjaman.destroy');
      Route::get('peminjaman/{id}', [PeminjamanFasilitasController::class, 'show'])->name('peminjaman.show');

        // Syarat Fasilitas
      Route::get('syarat_fasilitas/create', [SyaratFasilitasController::class, 'create'])->name('syarat_fasilitas.create');
      Route::get('syarat_fasilitas/{id}/edit', [SyaratFasilitasController::class, 'edit'])->name('syarat_fasilitas.edit');
      Route::put('syarat_fasilitas/{id}', [SyaratFasilitasController::class, 'update'])->name('syarat_fasilitas.update');
      Route::delete('syarat_fasilitas/{id}', [SyaratFasilitasController::class, 'destroy'])->name('syarat_fasilitas.destroy');
      Route::delete('/syarat-fasilitas/media/{media_id}', [SyaratFasilitasController::class, 'deleteMedia'])->name('syarat_fasilitas.deleteMedia');


    // Pembayaran Fasilitas
        Route::get('pembayaran_fasilitas/{id}/edit', [PembayaranFasilitasController::class, 'edit'])->name('pembayaran_fasilitas.edit');
        Route::put('pembayaran_fasilitas/{id}', [PembayaranFasilitasController::class, 'update'])->name('pembayaran_fasilitas.update');
        // Route untuk Show
        // Route untuk Destroy (Hapus Data)
        Route::delete('pembayaran_fasilitas/{id}', [PembayaranFasilitasController::class, 'destroy'])->name('pembayaran_fasilitas.destroy');
        Route::delete('/pembayaran_fasilitas/media/{media_id}', [PembayaranFasilitasController::class, 'deleteMedia'])->name('pembayaran.deleteMedia');



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


