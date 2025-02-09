<?php

namespace App\Livewire\PeminjamanBarang;

use App\Models\BarangInventaris;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TambahPengembalianBarang extends Component
{
    public $peminjaman_id;
    public $barang_kode;
    public $status_pmj;
    public $tanggal_entry;
    public function render()
    {
        $peminjamans = Peminjaman::all();
        $barangs = BarangInventaris::all();
        return view('livewire.peminjaman-barang.tambah-pengembalian-barang', ['peminjaman' => $peminjamans, 'barang' => $barangs]);
    }
    public function store()
    {
        $this->validate([
            'peminjaman_id' => 'required|exists:peminjaman,peminjaman_id',
            'barang_kode' => 'required|exists:barang_inventaris,barang_kode',
            'status_pmj' => 'required|in:0,1',
            'tanggal_entry' => 'required|date',
        ]);

        // Ambil tahun, bulan, dan nomor urut dari peminjaman_id
        $tahun = substr($this->peminjaman_id, 2, 4);
        $bulan = substr($this->peminjaman_id, 6, 2);
        $urutPeminjaman = substr($this->peminjaman_id, 8, 3);

        // Cek nomor urut terakhir untuk peminjaman_id yang sama
        $noUrutBaru = DB::table('peminjaman_barang')
            ->select(DB::raw("IFNULL(MAX(CAST(SUBSTRING(pjm_barang_id, 12, 3) AS UNSIGNED)), 0) + 1 AS no_urut"))
            ->where(DB::raw("SUBSTRING(pjm_barang_id, 1, 10)"), $this->peminjaman_id)
            ->value('no_urut');

        $noUrutBaru = str_pad($noUrutBaru, 3, '0', STR_PAD_LEFT);

        // Format pjm_barang_id sesuai dengan aturan yang diinginkan
        $pjm_barang_id = "{$this->peminjaman_id}{$noUrutBaru}";

        while (DB::table('peminjaman_barang')->where('pjm_barang_id', $pjm_barang_id)->exists()) {
            $noUrutBaru++;
            $noUrutBaru = str_pad($noUrutBaru, 3, '0', STR_PAD_LEFT);
            $pjm_barang_id = "{$this->peminjaman_id}{$noUrutBaru}";
        }

        // Simpan data ke database
        DB::table('peminjaman_barang')->insert([
            'pjm_barang_id' => $pjm_barang_id,
            'peminjaman_id' => $this->peminjaman_id,
            'barang_kode' => $this->barang_kode,
            'status_pmj' => $this->status_pmj,
            'tanggal_entry' => $this->tanggal_entry,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('message', 'Barang berhasil dipinjam!');
        return redirect()->route('daftar-peminjaman');
    }
}
