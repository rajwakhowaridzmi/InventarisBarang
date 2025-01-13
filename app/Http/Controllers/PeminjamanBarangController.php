<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanBarangController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'pb_id' => 'required|exists:tm_peminjaman,pb_id',
            'br_kode' => 'required|exists:tm_barang_inventaris,br_kode',
        ]);

        $thn_sekarang = Carbon::now()->format('Y');
        $bln_sekarang = Carbon::now()->format('m');

        $no_urut = DB::table('td_peminjaman_barang')
        ->selectRaw("IFNULL(MAX(SUBSTRING(pbd_id, 10, 3)), 0) + 1 AS no_urut")
            ->whereRaw("SUBSTRING(pbd_id, 4, 4) = ?", [$thn_sekarang])
            ->whereRaw("SUBSTRING(pbd_id, 8, 2) = ?", [$bln_sekarang])
            ->value('no_urut');

        $no_urut_padded = str_pad($no_urut, 3, '0', STR_PAD_LEFT);
        $pbd_id = 'PJBR' . $thn_sekarang . $bln_sekarang . $no_urut_padded;

        DB::table('td_peminjaman_barang')->insert([
            'pbd_id' => $pbd_id,
            'pb_id' => $request->input('pb_id'),
            'br_kode' => $request->input('br_kode'),
            'pdb_tgl' => Carbon::now(),
            'pdb_sts' => '1',
        ]);

        return response()->json([
            'message' => 'Data peminjaman barang berhasil ditambahkan',
            'pbd_id' => $pbd_id,
            'pb_id' => $request->input('pb_id'),
            'br_kode' => $request->input('br_kode'),
        ], 201);
    }
}
