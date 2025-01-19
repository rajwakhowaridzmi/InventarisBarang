<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanBarangController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,peminjaman_id',
            'barang_kode' => 'required|exists:barang_inventaris,barang_kode',
            'status_pmj' => 'nullable|in:0,1',
        ]);

        $peminjaman_id = $request->peminjaman_id;
        $noPeminjamanBarang = DB::table('peminjaman_barang')
            ->where('peminjaman_id', $peminjaman_id)
            ->count() + 1;

        $noPeminjamanBarang = str_pad($noPeminjamanBarang, 3, '0', STR_PAD_LEFT);
        $pjm_barang_id = $peminjaman_id . $noPeminjamanBarang;

        DB::table('peminjaman_barang')->insert([
            'pjm_barang_id' => $pjm_barang_id,
            'peminjaman_id' => $request->peminjaman_id,
            'barang_kode' => $request->barang_kode,
            'status_pmj' => $request->status_pmj,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $dataPeminjamanBarang = DB::table('peminjaman_barang')->get();
        return response()->json([
            'message' => 'Peminjaman barang berhasil ditambahkan',
            'data' => $dataPeminjamanBarang,
        ], 201);
    }

    public function index()
    {
        $peminjamanBarang = PeminjamanBarang::with(['peminjaman', 'barangInventaris'])->get();
        return response()->json($peminjamanBarang);
    }
    public function show($id)
    {
        $peminjamanBarang = PeminjamanBarang::find($id);

        if (!$peminjamanBarang) {
            return response()->json(['message' => 'Peminjaman barang tidak ditemukan'], 404);
        }

        return response()->json($peminjamanBarang);
    }

    public function update(Request $request, $id)
    {
        $peminjamanBarang = PeminjamanBarang::find($id);

        if (!$peminjamanBarang) {
            return response()->json(['message' => 'Peminjaman barang tidak ditemukan'], 404);
        }

        $request->validate([
            'barang_kode' => 'required|exists:barang_inventaris,barang_kode',
            'status_pmj' => 'nullable|in:0,1',
        ]);

        $peminjamanBarang->update($request->only(['barang_kode', 'status_pmj']));

        return response()->json([
            'message' => 'Peminjaman barang berhasil diperbarui',
            'data' => $peminjamanBarang,
        ]);
    }
    public function destroy($id)
    {
        $peminjamanBarang = PeminjamanBarang::find($id);

        if (!$peminjamanBarang) {
            return response()->json(['message' => 'Peminjaman barang tidak ditemukan'], 404);
        }

        $peminjamanBarang->delete();

        return response()->json(['message' => 'Peminjaman barang berhasil dihapus']);
    }
}
