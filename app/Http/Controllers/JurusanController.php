<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            // 'jurusan_id' => 'required|string|max:20|unique:jurusan,jurusan_id',
            'nama_jurusan' => 'required|string|max:50',
        ]);

        $jurusan = Jurusan::create([
            // 'jurusan_id' => $request->jurusan_id,
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return response()->json([
            'message' => 'Data Jurusan Berhasil ditambahkan',
            'data' => $jurusan,
        ], 201);
    }

    public function index()
    {
        $jurusan = Jurusan::all(); // Mengambil semua data dari tabel jurusan

        return response()->json([
            'message' => 'Data jurusan berhasil diambil',
            'data' => $jurusan,
        ], 200);
    }

    // public function show($id)
    // {
    //     $jurusan = Jurusan::find($id);

    //     if (!$jurusan) {
    //         return response()->json([
    //             'message' => 'tidak ada data',
    //         ], 404);
    //     }

    //     return response()->json([
    //         'message' => 'Detail Jurusan Berhasil Ditambahakan',
    //         'data' => $jurusan,
    //     ], 200);
    // }

    public function update(Request $request, $jurusan_id)
{
    // Cari data jurusan berdasarkan jurusan_id
    $jurusan = Jurusan::find($jurusan_id);

    // Jika data tidak ditemukan, kembalikan response 404
    if (!$jurusan) {
        return response()->json([
            'message' => 'Data jurusan tidak ditemukan',
        ], 404);
    }

    // Validasi input, hanya menerima nama_jurusan
    $request->validate([
        'nama_jurusan' => 'required|string|max:50',
    ]);

    // Update data jurusan
    $jurusan->update([
        'nama_jurusan' => $request->nama_jurusan,
    ]);

    // Kembalikan response dengan data yang diperbarui
    return response()->json([
        'message' => 'Data jurusan berhasil diupdate',
        'data' => $jurusan,
    ], 200);
}


    public function destroy($id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return response()->json([
                'message' => 'Data jurusan tidak ditemukan',
            ], 404);
        }

        $jurusan->delete();

        return response()->json([
            'message' => 'Data jurusan berhasil dihapus',
        ], 200);
    }
}
