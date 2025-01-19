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
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\SiswaController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Rute untuk login, logout, dan signup
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');  // Gunakan Sanctum middleware untuk logout


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

Route::middleware('auth:sanctum')->prefix('peminjaman')->group(function(){
    Route::post('/create', [PeminjamanController::class, 'store']);
    Route::get('/read', [PeminjamanController::class, 'index']); 
    Route::get('/read/{id}', [PeminjamanController::class, 'show']); 
    Route::put('/update/{id}', [PeminjamanController::class, 'update']); 
    Route::delete('/delete/{id}', [PeminjamanController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('pengembalian')->group(function(){
    Route::post('/create', [PengembalianController::class, 'store']);
    Route::get('/read', [PengembalianController::class, 'index']); 
    Route::get('/read/{id}', [PengembalianController::class, 'show']); 
    Route::put('/update/{id}', [PengembalianController::class, 'update']); 
    Route::delete('/delete/{id}', [PengembalianController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('peminjaman-barang')->group(function(){
    Route::post('/create', [PeminjamanBarangController::class, 'store']);
    Route::get('/read', [PeminjamanBarangController::class, 'index']);
    Route::get('/read/{id}', [PeminjamanBarangController::class, 'show']);
    Route::put('/update/{id}', [PeminjamanBarangController::class, 'update']);
    Route::delete('/delete/{id}', [PeminjamanBarangController::class, 'destroy']);
});
