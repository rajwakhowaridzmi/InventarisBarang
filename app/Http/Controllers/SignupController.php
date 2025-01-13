<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SignupController extends Controller
{
    /**
     * Menangani pendaftaran pengguna baru untuk API menggunakan MD5 untuk password.
     */
    public function signUp(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'user_nama' => 'required|string|unique:tm_user,user_nama',  // Pastikan user_nama unik
            'user_pass' => 'required|string|max:32',  // Pastikan password cukup kuat
        ]);

        // Encrypt password menggunakan MD5
        $encryptedPassword = md5($request->user_pass); // Menggunakan MD5 untuk enkripsi password

        // $user_id = uniqid('');
        // Simpan data pengguna baru
        DB::table('tm_user')->insert([
            // 'user_id' => $user_id,
            'user_nama' => $request->user_nama,
            'user_pass' => $encryptedPassword,  // Menggunakan MD5 yang sudah dienkripsi
            'user_sts' => '1',  // Status aktif
            'user_hak' => '1',  // Hak akses user biasa
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Ambil data user yang baru dibuat
        $userData = DB::table('tm_user')->where('user_nama', $request->user_nama)->first();

        // Generate token API
        $token = $userData->createToken('token')->plainTextToken;  // Pastikan Anda telah mengonfigurasi Laravel Sanctum

        return response()->json([
            'message' => 'Pendaftaran berhasil',
            'token' => $token,  // Kirim token untuk digunakan oleh klien
            'user' => $userData
        ], 201);
    }
}
