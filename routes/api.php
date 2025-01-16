<?php

use App\Http\Controllers\AsalBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangInventarisController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\PeminjamanBarangController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Rute untuk login, logout, dan signup
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');  // Gunakan Sanctum middleware untuk logout

// Rute untuk mengelola barang
Route::middleware('auth:sanctum')->post('/barang/store', [BarangController::class, 'store']);

Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->middleware('auth:api');

Route::post('/peminjaman-barang', [PeminjamanBarangController::class, 'store'])->middleware('auth:api');


Route::middleware('auth:sanctum')->prefix('jurusan')->group(function () {
    Route::post('/create', [JurusanController::class, 'store']); // CREATE
    Route::get('/read', [JurusanController::class, 'index']); // READ ALL
    // Route::get('/read/{id}', [JurusanController::class, 'show']); // READ DETAIL
    Route::put('/update/{id}', [JurusanController::class, 'update']); // UPDATE
    Route::delete('/delete/{id}', [JurusanController::class, 'destroy']); // DELETE
});

Route::middleware('auth:sanctum')->prefix('kelas')->group(function () {
    Route::post('/create', [KelasController::class, 'store']); // CREATE
    Route::get('/read', [KelasController::class, 'index']); // READ ALL
    Route::get('/read/{id}', [KelasController::class, 'show']); // READ DETAIL
    Route::put('/update/{id}', [KelasController::class, 'update']); // UPDATE
    Route::delete('/delete/{id}', [KelasController::class, 'destroy']); // DELETE
});

Route::middleware('auth:sanctum')->prefix('siswa')->group(function () {
    Route::post('/create', [SiswaController::class, 'store']); // CREATE
    Route::get('/read', [SiswaController::class, 'index']); // READ ALL
    Route::get('/read/{id}', [SiswaController::class, 'show']); // READ DETAIL
    Route::put('/update/{id}', [SiswaController::class, 'update']); // UPDATE
    Route::delete('/delete/{id}', [SiswaController::class, 'destroy']); // DELETE
});

Route::middleware('auth:sanctum')->prefix('jenis-barang')->group(function () {
    Route::post('/create', [JenisBarangController::class, 'store']);
    Route::get('/read', [JenisBarangController::class, 'index']);
    Route::get('/read/{id}', [JenisBarangController::class, 'show']);
    Route::put('/update/{id}', [JenisBarangController::class, 'update']);
    Route::delete('/delete/{id}', [JenisBarangController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('asal-barang')->group(function() {
    Route::post('/create', [AsalBarangController::class, 'store']);
    Route::get('/read', [AsalBarangController::class, 'index']);
    Route::get('/read/{id}', [AsalBarangController::class, 'show']);
    Route::put('/update/{id}', [AsalBarangController::class, 'update']);
    Route::delete('/delete/{id}', [AsalBarangController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('barang-inventaris')->group(function() {
    Route::post('/create', [BarangInventarisController::class, 'store']);
    Route::get('/read', [BarangInventarisController::class, 'index']); 
    Route::get('/read/{barang_kode}', [BarangInventarisController::class, 'show']); 
    Route::put('/update/{barang_kode}', [BarangInventarisController::class, 'update']); 
    Route::delete('/delete/{barang_kode}', [BarangInventarisController::class, 'destroy']);
});

