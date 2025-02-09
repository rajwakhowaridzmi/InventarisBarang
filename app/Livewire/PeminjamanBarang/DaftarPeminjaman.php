<?php

namespace App\Livewire\PeminjamanBarang;

use App\Models\Peminjaman;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarPeminjaman extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $filterTanggal;
    public $filterStatus;
    public function updatingFilterTanggal()
    {
        $this->resetPage();
    }
    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function filterData() {}

    public function render()
    {
        $query = Peminjaman::with(['siswa.kelas.jurusan', 'user'])
            ->orderBy('peminjaman_id', 'desc');

        if ($this->filterTanggal) {
            $query->whereDate('tanggal_pinjam', $this->filterTanggal);
        }

        if ($this->filterStatus !== "" && !is_null($this->filterStatus)) {
            $query->where('peminjaman_status', $this->filterStatus);
        }

        $peminjamans = $query->paginate(5)->withQueryString();

        return view('livewire.peminjaman-barang.daftar-peminjaman', [
            'peminjaman' => $peminjamans,
        ]);
    }
}
