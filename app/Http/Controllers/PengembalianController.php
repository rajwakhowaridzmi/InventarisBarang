<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,peminjaman_id',
            'tanggal_kembali' => 'required|date',
            'kembali_status' => 'required|in:0,1',
        ]);

        $tahunSekarang = date('Y');
        $bulanSekarang = date('m');

        $noUrutBaru = DB::table('pengembalian')
            ->select(DB::raw("IFNULL(MAX(SUBSTRING(pengembalian_id, 3, 4)), 0) + 1 AS no_urut"))
            ->where(DB::raw("SUBSTRING(pengembalian_id, 3, 4)"), $tahunSekarang)
            ->value('no_urut');

        $noUrutBaru = str_pad($noUrutBaru, 4, '0', STR_PAD_LEFT);

        $pengembalianId = "KB" . $tahunSekarang . $bulanSekarang . $noUrutBaru;

        $user_id = Auth::user()->user_id;

        DB::table('pengembalian')->insert([
            'pengembalian_id' => $pengembalianId,
            'peminjaman_id' => $request->peminjaman_id,
            'user_id' => $user_id,
            'tanggal_kembali' => $request->tanggal_kembali,
            'kembali_status' => $request->kembali_status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $dataPengembalian = DB::table('pengembalian')->get();

        return response()->json([
            'message' => 'Pengembalian berhasil ditambahkan',
            'data' => $dataPengembalian,
        ], 201);
    }
    public function index()
    {
        $pengembalian = Pengembalian::with(['peminjaman', 'user'])->get();
        return response()->json($pengembalian);
    }
    public function show($id)
    {
        // Cari data pengembalian berdasarkan ID
        $pengembalian = Pengembalian::find($id);

        // Jika data tidak ditemukan
        if (!$pengembalian) {
            return response()->json(['message' => 'Pengembalian tidak ditemukan'], 404);
        }

        return response()->json($pengembalian);
    }
    public function update(Request $request, $id)
    {
        $pengembalian = Pengembalian::find($id);

        if (!$pengembalian) {
            return response()->json(['message' => 'Pengembalian tidak ditemukan'], 404);
        }

        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,peminjaman_id',
            'tanggal_kembali' => 'required|date',
            'kembali_status' => 'required|in:0,1',
        ]);

        $pengembalian->update($request->all());

        return response()->json([
            'message' => 'Pengembalian berhasil diperbarui',
            'data' => $pengembalian,
        ]);
    }
    public function destroy($id)
    {
        $pengembalian = Pengembalian::find($id);

        if (!$pengembalian) {
            return response()->json(['message' => 'Pengembalian tidak ditemukan'], 404);
        }

        $pengembalian->delete();

        return response()->json(['message' => 'Pengembalian berhasil dihapus']);
    }
}
