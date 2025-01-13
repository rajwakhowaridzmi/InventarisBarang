<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisBarangController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jns_brg_kode' => 'required|string|max:5|unique:tr_jenis_barang,jns_brg_kode',
            'jns_brg_nama' => 'nullable|string|max:50',
        ]);

        DB::table('tr_jenis_barang')-> insert([
            'jns_brg_kode' => $validated['jns_brg_kode'],
            'jns_brg_nama' => $validated['jns_brg_nama'],
        ]);

        return response()->json([
            'message' => 'Jenis barang telah ditambahkan',
            'jns_brg_kode' => $validated['jns_brg_kode'],
            'jns_brg_nama' => $validated['jns_brg_nama'],
        ], 201);
    }
}
