<?php
namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            // 'user_id' => 'required|exists:user,id',
            'tanggal_pinjam' => 'required|date',
            'harus_kembali_tgl' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $tahunSekarang = date('Y');
        $bulanSekarang = date('m');
        
        $noUrutBaru = DB::table('peminjaman')
            ->select(DB::raw("IFNULL(MAX(SUBSTRING(peminjaman_id, 7, 4)), 0) + 1 AS no_urut"))
            ->where(DB::raw("SUBSTRING(peminjaman_id, 3, 4)"), $tahunSekarang)
            ->where(DB::raw("SUBSTRING(peminjaman_id, 5, 2)"), $bulanSekarang)
            ->value('no_urut');
        
        $noUrutBaru = str_pad($noUrutBaru, 4, '0', STR_PAD_LEFT);

        $peminjamanId = "PJ" . $tahunSekarang . $bulanSekarang . $noUrutBaru;
        

        $user_id = Auth::user()->user_id;

        DB::table('peminjaman')->insert([
            'peminjaman_id' => $peminjamanId,
            'siswa_id' => $request->siswa_id,
            'user_id' => $user_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'harus_kembali_tgl' => $request->harus_kembali_tgl,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $dataPeminjaman = DB::table('peminjaman')->get();

        return response()->json([
            'message' => 'Peminjaman berhasil ditambahkan',
            'data' => $dataPeminjaman,
        ], 201);
    }
    public function index()
    {
        $peminjaman = Peminjaman::with(['siswa', 'user'])->get();
        return response()->json($peminjaman);
    }
    public function show($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json(['message' => 'Peminjaman tidak ditemukan'], 404);
        }

        return response()->json($peminjaman);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'user_id' => 'required|exists:user,id',
            'tanggal_pinjam' => 'required|date',
            'harus_kembali_tgl' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json(['message' => 'Peminjaman tidak ditemukan'], 404);
        }

        $peminjaman->siswa_id = $request->siswa_id;
        $peminjaman->user_id = $request->user_id;
        $peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
        $peminjaman->harus_kembali_tgl = $request->harus_kembali_tgl;
        $peminjaman->save();

        return response()->json(['message' => 'Peminjaman berhasil diperbarui', 'data' => $peminjaman]);
    }
    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json(['message' => 'Peminjaman tidak ditemukan'], 404);
        }

        $peminjaman->delete();

        return response()->json(['message' => 'Peminjaman berhasil dihapus']);
    }

}
