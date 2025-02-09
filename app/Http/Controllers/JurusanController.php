<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:50',
        ]);

        $jurusan = Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('jurusan.index')->with('succes', 'Data Berhasil ditambahkan');
        // return response()->json([
        //     'message' => 'Data Jurusan Berhasil ditambahkan',
        //     'data' => $jurusan,
        // ], 201);
    }

    public function index()
    {
        $jurusan = Jurusan::all(); // Mengambil semua data dari tabel jurusan

        return view('livewire.siswa.jurusan', compact('jurusan'));
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
        $jurusan = Jurusan::find($jurusan_id);

        if (!$jurusan) {
            return redirect()->route('jurusan.index')->with('error', 'Data jurusan tidak ditemukan');
        }

        $request->validate([
            'nama_jurusan' => 'required|string|max:50',
        ]);

        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil diupdate');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return redirect()->route('jurusan.index')->with('error', 'Data jurusan tidak ditemukan');
        }

        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil dihapus');
    }
}
