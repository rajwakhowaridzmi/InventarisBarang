<?php

namespace App\Livewire;

use App\Models\BarangInventaris;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalBarang, $totalPengembalian, $totalPeminjaman, $totalSiswa, $chartData;

    public function mount()
    {
        // Hitung total data
        $this->totalBarang = BarangInventaris::count();
        $this->totalSiswa = Siswa::count();
        $this->totalPeminjaman = Peminjaman::count();
        $this->totalPengembalian = Pengembalian::count();

        // Ambil data peminjaman untuk 30 hari terakhir
        $peminjamanData = Peminjaman::where('created_at', '>=', now()->subDays(30))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Ambil data pengembalian untuk 30 hari terakhir
        $pengembalianData = Pengembalian::where('created_at', '>=', now()->subDays(30))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Gabungkan kategori tanggal untuk menghindari ketidaksesuaian
        $categories = collect(array_merge(
            $peminjamanData->pluck('date')->toArray(),
            $pengembalianData->pluck('date')->toArray()
        ))->unique()->sort()->values();

        // Map data peminjaman dan pengembalian ke kategori tanggal
        $peminjamanMapped = $categories->map(fn($date) => $peminjamanData->firstWhere('date', $date)->total ?? 0);
        $pengembalianMapped = $categories->map(fn($date) => $pengembalianData->firstWhere('date', $date)->total ?? 0);

        $this->chartData = [
            'categories' => $categories,
            'peminjaman' => $peminjamanMapped,
            'pengembalian' => $pengembalianMapped,
        ];
    }
    public function render()
    {
        return view('livewire.dashboard', [
            'totalBarang' => $this->totalBarang,
            'totalPeminjaman' => $this->totalPeminjaman,
            'totalPengembalian' => $this->totalPengembalian,
            'totalSiswa' => $this->totalSiswa,
            'chartData' => $this->chartData
        ]);
    }
}
