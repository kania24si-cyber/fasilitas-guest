<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FasilitasUmumController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fasilitas', [FasilitasUmumController::class, 'index']);
