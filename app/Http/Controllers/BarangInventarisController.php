<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarangInventarisController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jns_brg_kode' => 'required|exists:jenis_barang,jns_brg_kode',
            // 'user_id' => 'required|exists:user,user_id',
            'nama_barang' => 'required|string|max:50',
            'tanggal_terima' => 'required|date',
            'tanggal_entry' => 'required|date',
            'kondisi_barang' => 'required|in:0,1',
            'status_barang' => 'required|in:0,1',
            'asal_id' => 'required|exists:asal,asal_id',
        ]);

        $tahunSekarang = date('Y');

        $noUrutBaru = DB::table('barang_inventaris')
            ->select(DB::raw("IFNULL(MAX(SUBSTRING(barang_kode, 8, 5)), 0) + 1 AS no_urut"))
            ->where(DB::raw("SUBSTRING(barang_kode, 4, 4)"), $tahunSekarang)
            ->value('no_urut');

        $noUrutBaru = str_pad($noUrutBaru, 5, '0', STR_PAD_LEFT);

        $barangKode = "INV" . $tahunSekarang . $noUrutBaru;

        $user_id = Auth::user()->user_id;

        $barang = DB::table('barang_inventaris')->insert([
            'barang_kode' => $barangKode,
            'jns_brg_kode' => $request->jns_brg_kode,
            'user_id' => $user_id,
            'nama_barang' => $request->nama_barang,
            'tanggal_terima' => $request->tanggal_terima,
            'tanggal_entry' => $request->tanggal_entry,
            'kondisi_barang' => $request->kondisi_barang,
            'status_barang' => $request->status_barang,
            'asal_id' => $request->asal_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $dataBarang = DB::table('barang_inventaris')->get();

        return response()->json([
            'message' => 'Barang berhasil ditambahkan',
            'data' => $dataBarang,
        ], 201);
    }

    public function index(Request $request)
{
    $barang = BarangInventaris::with(['jenisBarang', 'user', 'asal'])->get();
    
    // Cek jika parameter 'view' ada di query string
    if ($request->query('view') === 'laporan') {
        return view('livewire.laporan.laporan-daftar-barang', compact('barang'));
    }

    // Jika tidak, tampilkan tampilan default
    return view('livewire.barang-inventaris.daftar-barang', compact('barang'));
}


    public function show($id)
    {
        $barang = BarangInventaris::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }

        return response()->json($barang);
    }

    public function update(Request $request, $id) {
        $barang = BarangInventaris::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }

        $request->validate([
            'jns_brg_kode' => 'required|exists:jenis_barang,jns_brg_kode',
            'user_id' => 'required|exists:users,user_id',
            'nama_barang' => 'required|string|max:50',
            'tanggal_terima' => 'required|date',
            'tanggal_entry' => 'required|date',
            'kondisi_barang' => 'required|in:0,1',
            'status_barang' => 'required|in:0,1',
            'asal_id' => 'required|exists:asal_barang,asal_id',
        ]);

        $barang->update($request->all());

        return response()->json([
            'message' => 'Barang berhasil diperbarui',
            'data' => $barang,
        ]);
    }

    public function destroy($id)
    {
        $barang = BarangInventaris::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }

        $barang->delete();

        return response()->json(['message' => 'Barang berhasil dihapus']);
    }

}
