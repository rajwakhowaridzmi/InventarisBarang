<?php

namespace App\Livewire\PeminjamanBarang;

use App\Models\Peminjaman;
use App\Models\PeminjamanBarang;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetailPeminjaman extends Component
{
    public $peminjaman_id, $siswa_id, $user_id, $tanggal_pinjam, $harus_kembali_tgl, $peminjaman_status, $user_nama;
    public $barang_list = [];

    public function mount($peminjaman_id)
    {
        $peminjaman = Peminjaman::where('peminjaman_id', $peminjaman_id)->with('siswa', 'user')->first();

        if (!$peminjaman) {
            session()->flash('error', 'Data peminjaman tidak ditemukan.');
            return redirect()->route('daftar-peminjaman'); // Redirect jika tidak ditemukan
        }

        $this->peminjaman_id = $peminjaman->peminjaman_id;
        $this->siswa_id = $peminjaman->siswa_id;
        $this->user_id = $peminjaman->user_id;
        $this->tanggal_pinjam = $peminjaman->tanggal_pinjam;
        $this->harus_kembali_tgl = $peminjaman->harus_kembali_tgl;
        $this->peminjaman_status = $peminjaman->peminjaman_status;
        $this->user_nama = $peminjaman->user->user_nama ?? '-';
        $this->barang_list = DB::table('peminjaman_barang')
        ->join('barang_inventaris', 'peminjaman_barang.barang_kode', '=', 'barang_inventaris.barang_kode')
        ->where('peminjaman_barang.peminjaman_id', $peminjaman_id)
        ->select('peminjaman_barang.barang_kode', 'barang_inventaris.nama_barang')
        ->get()
        ->toArray();
    }

    public function render()
    {
        $siswas = Siswa::all();
        return view('livewire.peminjaman-barang.detail-peminjaman', ['siswa' => $siswas, 'barang_list' => $this->barang_list]);
    }
}
