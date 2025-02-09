<?php

namespace App\Livewire\Laporan;

use App\Exports\PengembalianExport;
use App\Models\Pengembalian;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPengembalianBarang extends Component
{
    public $pengembalian_id;
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    public function exportPDF()
    {
        $pengembalians = Pengembalian::with(['peminjaman.siswa.kelas'])->get();

        $pdf = Pdf::loadView('livewire.laporan.export-pdf-pengembalian', compact('pengembalians'))
            ->setPaper('A4', 'landscape');

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'Laporan_Pengembalian.pdf'
        );
    }
    public function exportExcel()
    {
        return Excel::download(new PengembalianExport, 'Laporan_Pengembalian.xlsx');
    }
    
    public function render()
    {
        $pengembalians = Pengembalian::with(['peminjaman.siswa.kelas'])
            ->orderBy('pengembalian_id')
            ->paginate(5);
        return view('livewire.laporan.laporan-pengembalian-barang', ['pengembalian' => $pengembalians]);
    }
}
