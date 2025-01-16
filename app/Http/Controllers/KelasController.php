<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function store(Request $request){
        $request->validate([
            // 'kelas_id' => 'required|string|max:20|unique:kelas,kelas_id',
            'jurusan_id' => 'required|exists:jurusan,jurusan_id',
            'tingkat' => 'nullable|in:10,11,12',
            'no_kosentrasi' => 'required|string|max:2',
        ]);

        $kelas = Kelas::create($request->all());

        return response()->json([
            'message' => 'Data Kelas Berhasil Ditambahkan', 
            'data' => $kelas,
        ], 201);
    }

    public function index(){
    $kelas = Kelas::with('jurusan')->get();
    return response()->json([
        'message' => 'Data kelas berhasil diambil',
        'data' => $kelas,
    ]);
}


    public function show($id)
    {
        $kelas = Kelas::find($id);

        if (!$kelas) {
            return response()->json([
                'message' => 'Data kelas tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'message' => 'Data kelas berhasil diambil',
            'data' => $kelas,
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $kelas = Kelas::find($id);

        if (!$kelas) {
            return response()->json([
                'message' => 'Data kelas tidak ditemukan',
            ], 404);
        }

        $request->validate([
            'jurusan_id' => 'required|exists:jurusan,jurusan_id',
            'tingkat' => 'nullable|in:10,11,12',
            'no_kosentrasi' => 'required|string|max:2',
        ]);

        $kelas->update($request->only('jurusan_id', 'tingkat', 'no_kosentrasi'));

        return response()->json([
            'message' => 'Data kelas berhasil diedit',
            'data' => $kelas,
        ], 200);
    }
    public function destroy($id)
    {
        $kelas = Kelas::find($id);

        if (!$kelas) {
            return response()->json([
                'message' => 'Data kelas tidak ditemukan',
            ], 404);
        }

        $kelas->delete();

        return response()->json([
            'message' => 'Data kelas berhasil dihapus',
        ], 200);
    }

}
