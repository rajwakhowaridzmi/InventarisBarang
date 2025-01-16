<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'user_nama' => 'required|string|max:50', // Validasi input
            'user_pass' => 'required|string|max:32',
        ]);

        // Cari user berdasarkan user_nama
        $user = User::where('user_nama', $request->user_nama)->first();

        // Verifikasi password dengan MD5
        if ($user && md5($request->user_pass) === $user->user_pass) {
            // Login pengguna
            Auth::login($user);

            // Membuat token Sanctum
            $token = $user->createToken('token')->plainTextToken;

            return response()->json([
                'message' => 'Login berhasil',
                'token' => $token,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Nama pengguna atau Password salah',
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        // Hapus token akses saat ini
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil',
        ], 200);
    }
}
