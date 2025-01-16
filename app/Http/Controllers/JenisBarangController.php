<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisBarangController extends Controller
{
    public function index(){
        $jenisBarang = JenisBarang::all();
        return response()->json($jenisBarang);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jns_brg_kode' => 'required|string|max:5|unique:jenis_barang,jns_brg_kode',
            'jns_brg_nama' => 'nullable|string|max:50',
        ]);

        $jenisBarang = JenisBarang::create([
            'jns_brg_kode' => $request->jns_brg_kode,
            'jns_brg_nama' => $request->jns_brg_nama,
        ]);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $jenisBarang,
        ], 201);
    }

    public function show($id)
    {
        $jenisBarang = JenisBarang::findOrFail($id);
        return response()->json($jenisBarang);
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $request->validate([
            'jns_brg_nama' => 'nullable|string|max:50',
        ]);

        $jenisBarang = JenisBarang::findOrFail($id);
        $jenisBarang->update([
            'jns_brg_nama' => $request->jns_brg_nama,
        ]);

        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => $jenisBarang,
        ]);
    }

    public function destroy($id)
    {
        $jenisBarang = JenisBarang::findOrFail($id);
        $jenisBarang->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
