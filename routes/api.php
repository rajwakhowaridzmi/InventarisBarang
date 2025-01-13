<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\PeminjamanBarangController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Rute untuk login, logout, dan signup
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');  // Gunakan Sanctum middleware untuk logout
Route::post('signup', [SignupController::class, 'signUp']);

// Rute untuk mengelola barang
Route::middleware('auth:sanctum')->post('/barang/store', [BarangController::class, 'store']);

Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->middleware('auth:api');

Route::post('/tambah-jenis-barang', [JenisBarangController::class, 'store']);

Route::post('/peminjaman-barang', [PeminjamanBarangController::class, 'store'])->middleware('auth:api');




