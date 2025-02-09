<?php

namespace App\Livewire\PeminjamanBarang;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TambahPengembalian extends Component
{
    public $peminjaman_id;
    // public $tanggal_kembali;
    public $user_id;
    public $user_nama;
    public $searchSiswa = '';
    public $filteredPeminjaman = [];
    public $siswa_id;
    public $kelas_siswa;
    public $barang_details = [];

    
    public function updatedSearchSiswa()
    {
        $this->filteredPeminjaman = Peminjaman::with('siswa.kelas.jurusan') // Load kelas dan jurusan
            ->whereHas('siswa', function ($query) {
                $query->where('nama', 'like', '%' . $this->searchSiswa . '%');
            })
            ->where('peminjaman_status', '1') // Hanya yang belum dikembalikan
            ->get();
    }
    public function selectPeminjaman($peminjamanId, $namaSiswa, $kelas)
    {
        $this->peminjaman_id = $peminjamanId;
        $this->searchSiswa = $peminjamanId . ' | ' . $namaSiswa . ' - ' . $kelas;
        $this->kelas_siswa = $kelas;
    
        // Ambil barang_kode dan nama_barang dari tabel barang_inventaris
        $this->barang_details = DB::table('peminjaman_barang')
            ->join('barang_inventaris', 'peminjaman_barang.barang_kode', '=', 'barang_inventaris.barang_kode')
            ->where('peminjaman_barang.peminjaman_id', $peminjamanId)
            ->select('peminjaman_barang.barang_kode', 'barang_inventaris.nama_barang')
            ->get()
            ->toArray();
    
        $this->filteredPeminjaman = [];
    }


    public function resetPeminjaman()
    {
        $this->peminjaman_id = null;
        $this->searchSiswa = '';
        $this->kelas_siswa = null;
    }

    public function konfirmasiPengembalian()
    {
        $this->store(); // Panggil fungsi store
        session()->flash('message', 'Pengembalian berhasil ditambahkan!');
        return redirect()->route('daftar-pengembalian');
    }

    public function mount()
    {
        $this->user_id = Auth::user()->user_id;
        $this->user_nama = DB::table('user')
            ->where('user_id', $this->user_id)
            ->value('user_nama');
    }
    public function render()
    {
        $peminjamans = Peminjaman::with('siswa.kelas.jurusan')
            ->where('peminjaman_status', '1')
            ->get();

        return view('livewire.peminjaman-barang.tambah-pengembalian', ['peminjaman' => $peminjamans]);
    }
    public function store()
    {
        $this->validate([
            'peminjaman_id' => 'required|exists:peminjaman,peminjaman_id',
        ]);

        $tahunSekarang = date('Y');
        $bulanSekarang = date('m');

        $noUrutBaru = DB::table('pengembalian')
            ->select(DB::raw("IFNULL(MAX(CAST(SUBSTRING(pengembalian_id, 7, 4) AS UNSIGNED)), 0) + 1 AS no_urut"))
            ->where(DB::raw("SUBSTRING(pengembalian_id, 3, 4)"), $tahunSekarang)
            ->where(DB::raw("SUBSTRING(pengembalian_id, 5, 2)"), $bulanSekarang)
            ->value('no_urut');

        $noUrutBaru = str_pad($noUrutBaru, 4, '0', STR_PAD_LEFT);
        $pengembalianId = "KB" . $tahunSekarang . $bulanSekarang . $noUrutBaru;

        while (DB::table('pengembalian')->where('pengembalian_id', $pengembalianId)->exists()) {
            $noUrutBaru++;
            $noUrutBaru = str_pad($noUrutBaru, 4, '0', STR_PAD_LEFT);
            $pengembalianId = "KB" . $tahunSekarang . $bulanSekarang . $noUrutBaru;
        }

        $user_id = Auth::user()->user_id;
        DB::table('pengembalian')->insert([
            'pengembalian_id' => $pengembalianId,
            'peminjaman_id' => $this->peminjaman_id,
            'user_id' => $user_id,
            'tanggal_kembali' => now(),
            'kembali_status' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('peminjaman')
            ->where('peminjaman_id', $this->peminjaman_id)
            ->update(['peminjaman_status' => '0']);

        // Update status peminjaman barang menjadi '0'
        DB::table('peminjaman_barang')
            ->where('peminjaman_id', $this->peminjaman_id)
            ->update(['status_pmj' => '0']);

        // Ambil semua barang_kode terkait dengan peminjaman_id
        $barang_kodes = DB::table('peminjaman_barang')
            ->where('peminjaman_id', $this->peminjaman_id)
            ->pluck('barang_kode');

        // Update status barang menjadi '1' untuk setiap barang_kode yang terkait
        DB::table('barang_inventaris')
            ->whereIn('barang_kode', $barang_kodes)
            ->update(['status_barang' => '1']);

        session()->flash('message', 'Pengembalian berhasil ditambahkan!');
        return redirect()->route('daftar-pengembalian');
    }
}
