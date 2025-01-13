<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'jns_brg_kode' => 'required|string|max:5',
            'br_nama' => 'nullable|string|max:50',
            'br_tgl_terima' => 'nullable|date',
            'br_status' => 'nullable|string|max:2',
        ]);

        $thn_sekarang = Carbon::now()->format('Y');
        $no_urut = DB::table('tm_barang_inventaris')
            ->selectRaw("IFNULL(MAX(SUBSTRING(br_kode, 8, 5)), 0) + 1 AS no_urut")
            ->whereRaw("SUBSTRING(br_kode, 4, 4) = ?", [$thn_sekarang])
            ->value('no_urut');
        $no_urut_padded = str_pad($no_urut, 5, '0', STR_PAD_LEFT);
        $kode_barang = 'INV' . $thn_sekarang . $no_urut_padded;

        //menyimpan ke database
        DB::table('tm_barang_inventaris')->insert([
            'br_kode' => $kode_barang,
            'jns_brg_kode' => $request->input('jns_brg_kode'),
            'user_id' => $user->user_id,
            'br_nama' => $request->input('br_nama'),
            'br_tgl_terima' => $request->input('br_tgl_terima'),
            'br_tgl_entry' => now(),
            'br_status' => $request->input('br_status'),
        ]);

        return response()->json([
            'message' => 'Barang berhasil ditambahkan',
            'kode_barang' => $kode_barang,
        ]);
    }
}
