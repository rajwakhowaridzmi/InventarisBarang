<?php

namespace App\Livewire\PeminjamanBarang;

use App\Models\Pengembalian;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarPengembalian extends Component
{
    public $pengembalian_id;
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public function render()
    {
        $pengembalians = Pengembalian::with(['peminjaman.siswa.kelas'])
        ->orderBy('pengembalian_id', 'desc')
        ->paginate(5);
        return view('livewire.peminjaman-barang.daftar-pengembalian', ['pengembalian' => $pengembalians]);
    }
}
