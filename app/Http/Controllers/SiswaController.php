<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,kelas_id',
            'nama' => 'required|string|max:50',
            'nis' => 'required|unique:siswa,nis',
            'email' => 'required|email|unique:siswa,email',
            'siswa_status' => 'nullable|in:0,1',
        ]);

        $siswa = Siswa::create([
            'kelas_id' => $request->kelas_id,
            'nama' => $request->nama,
            'nis' => $request->nis,
            'email' => $request->email,
            'siswa_status' => $request->input('siswa_status', '0')
        ]);

        return response()->json([
            'message' => 'Siswa berhasil ditambahkan',
            'data' => $siswa,
        ], 201);
    }

    public function index()
    {
        $siswa = Siswa::with(['kelas.jurusan'])->get();
        return response()->json($siswa);
    }

    public function show($id)
    {
        $siswa = Siswa::with(['kelas.jurusan'])->find($id);

        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        return response()->json($siswa);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        $request->validate([
            'kelas_id' => 'required|exists:kelas,kelas_id',
            'nama' => 'required|string|max:50',
            'nis' => 'required|unique:siswa,nis,' . $id . ',siswa_id',  // Memastikan nis yang sama tetap bisa digunakan
            'email' => 'required|email|unique:siswa,email,' . $id . ',siswa_id',
            'siswa_status' => 'nullable|in:0,1'
        ]);

        // Update siswa dengan data yang ada dalam request
        $siswa->update([
            'kelas_id' => $request->kelas_id,
            'nama' => $request->nama,
            'nis' => $request->nis,
            'email' => $request->email,
            'siswa_status' => $request->siswa_status ?? $siswa->siswa_status,
        ]);

        return response()->json([
            'message' => 'Siswa berhasil diperbarui',
            'data' => $siswa,
        ], 200);
    }


    public function destroy($id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        $siswa->delete();

        return response()->json(['message' => 'Siswa berhasil dihapus'], 200);
    }
}
