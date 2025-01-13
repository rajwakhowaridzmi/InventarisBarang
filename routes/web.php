<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return view('welcome');
});


// Route::prefix('barang')->group(function () {
//     Route::post('/store', [BarangController::class, 'store']);
//     Route::get('/generate-kode', [BarangController::class, 'generateKodeBarang']);
// });
