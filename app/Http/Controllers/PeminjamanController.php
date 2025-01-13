<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'User tidak terautentikasi'], 401);
        }

        $validated = $request->validate([
            'pb_tgl' => 'required|date',
            'pb_no_siswa' => 'required|string|max:20',
            'pb_nama_siswa' => 'required|string|max:100',
            'pb_harus_kembali_tgl' => 'required|date',
            'pb_stat' => 'required|string|max:2',
        ]);

        $thn_sekarang = Carbon::now()->format('Y');
        $bln_sekarang = Carbon::now()->format('m');

        $no_urut = DB::table('tm_peminjaman')
            ->selectRaw("IFNULL(MAX(SUBSTRING(pb_id, 10, 3)), 0) + 1 AS no_urut")
            ->whereRaw("SUBSTRING(pb_id, 3, 4) = ?", [$thn_sekarang])
            ->whereRaw("SUBSTRING(pb_id, 7, 2) = ?", [$bln_sekarang])
            ->value('no_urut');

        $no_urut_padded = str_pad($no_urut, 3, '0', STR_PAD_LEFT);
        $id_transaksi = 'PJ' . $thn_sekarang . $bln_sekarang . $no_urut_padded;

        DB::table('tm_peminjaman')->insert([
            'pb_id' => $id_transaksi,
            'user_id' => $user->user_id,
            'pb_tgl' => $validated['pb_tgl'],
            'pb_no_siswa' => $validated['pb_no_siswa'],
            'pb_nama_siswa' => $validated['pb_nama_siswa'],
            'pb_harus_kembali_tgl' => $validated['pb_harus_kembali_tgl'],
            'pb_stat' => $validated['pb_stat'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Transaksi peminjaman berhasil ditambahkan',
            'pb_id' => $id_transaksi,
        ], 200);
    }
}
