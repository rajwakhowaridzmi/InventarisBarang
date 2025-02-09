<?php

namespace App\Livewire\PeminjamanBarang;

use App\Models\BarangInventaris;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TambahPeminjamanBarang extends Component
{
    public $peminjaman_id, $barang_kode = [], $status_pmj, $tanggal_entry;
    public function render()
    {
        $peminjamans = Peminjaman::all();
        $barangs = BarangInventaris::where('status_barang', '1')->get();
        return view('livewire.peminjaman-barang.tambah-peminjaman-barang', ['peminjaman' => $peminjamans, 'barang' => $barangs]);
    }
    public function store()
{
    $this->validate([
        'peminjaman_id' => 'required|exists:peminjaman,peminjaman_id',
        'barang_kode' => 'required|array',
        'barang_kode.*' => 'exists:barang_inventaris,barang_kode', 
        'status_pmj' => 'required|in:0,1',
        'tanggal_entry' => 'required|date',
    ]);

    foreach ($this->barang_kode as $kode) {
        $noUrutBaru = DB::table('peminjaman_barang')
            ->select(DB::raw("IFNULL(MAX(CAST(SUBSTRING(pjm_barang_id, 12, 3) AS UNSIGNED)), 0) + 1 AS no_urut"))
            ->where(DB::raw("SUBSTRING(pjm_barang_id, 1, 10)"), $this->peminjaman_id)
            ->value('no_urut');

        $noUrutBaru = str_pad($noUrutBaru, 3, '0', STR_PAD_LEFT);
        $pjm_barang_id = "{$this->peminjaman_id}{$noUrutBaru}";

        while (DB::table('peminjaman_barang')->where('pjm_barang_id', $pjm_barang_id)->exists()) {
            $noUrutBaru++;
            $noUrutBaru = str_pad($noUrutBaru, 3, '0', STR_PAD_LEFT);
            $pjm_barang_id = "{$this->peminjaman_id}{$noUrutBaru}";
        }

        DB::table('peminjaman_barang')->insert([
            'pjm_barang_id' => $pjm_barang_id,
            'peminjaman_id' => $this->peminjaman_id,
            'barang_kode' => $kode, 
            'status_pmj' => $this->status_pmj,
            'tanggal_entry' => $this->tanggal_entry,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Jika status peminjaman 1 (barang dipinjam), ubah status barang menjadi 0
        if ($this->status_pmj == '1') {
            DB::table('barang_inventaris')
                ->where('barang_kode', $kode)
                ->update(['status_barang' => '0']);
        }
    }

    session()->flash('message', 'Barang berhasil dipinjam!');
    return redirect()->route('daftar-peminjaman');
}

}
