<?php

namespace App\Livewire\PeminjamanBarang;

use App\Models\PeminjamanBarang;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarPengembalianBarang extends Component
{
    public $pjm_barang_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $pengembalian_barangs = PeminjamanBarang::with(['peminjaman.siswa.kelas', 'barangInventaris'])
        ->where('status_pmj', '1') 
        ->paginate(5);

    return view('livewire.peminjaman-barang.daftar-pengembalian-barang', [
        'pengembalian_barang' => $pengembalian_barangs
    ]);
    }
}
