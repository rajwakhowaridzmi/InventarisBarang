<?php

namespace App\Http\Controllers;

use App\Models\Asal;
use Illuminate\Http\Request;

class AsalBarangController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'asal_barang' => 'nullable|string|max:50',
        ]);

        // Hapus 'asal_id' karena itu auto-increment
        $asal = Asal::create([
            'asal_barang' => $request->asal_barang,
        ]);

        return response()->json([
            'message' => 'Data berhasil disimpan',
            'data' => $asal,
        ], 201);
    }


    public function index()
    {
        $data = Asal::all();
        return response()->json($data);
    }

    public function show($id)
    {
        $asal = Asal::findOrFail($id);

        return response()->json($asal);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'asal_barang' => 'nullable|string|max:50',
        ]);

        $asal = Asal::findOrFail($id);
        $asal->update([
            'asal_barang' => $request->asal_barang,
        ]);

        return response()->json([
            'message' => 'Data berhasil diedit',
            'data' => $asal,
        ]);
    }
    public function destroy($id)
    {
        $asal = Asal::findOrFail($id);
        $asal->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
