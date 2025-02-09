<?php

namespace App\Livewire\Laporan;

use App\Exports\BarangExport;
use App\Exports\StatusBarangExport;
use App\Models\Asal;
use App\Models\BarangInventaris;
use App\Models\JenisBarang;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class LaporanStatusBarang extends Component
{
    public $kondisi_barang, $status_barang;
    // public $jenisBarangList;
    // public $asalBarangList;
    public $jns_brg_nama;
    public $asal_barang;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    // public function mount()
    // {
    //     $this->jenisBarangList = JenisBarang::all();
    //     $this->asalBarangList = Asal::all();
    // }
    public function render()
    {
        $query = BarangInventaris::query()->with(['jenisBarang', 'Asal']);

        // if (!empty($this->jns_brg_nama)) {
        //     $query->where('jns_brg_kode', $this->jns_brg_nama);
        // }
        if ($this->kondisi_barang !== '' && $this->kondisi_barang !== null) {
            $query->where('kondisi_barang', $this->kondisi_barang);
        }
        if ($this->status_barang !== '' && $this->status_barang !== null) {
            $query->where('status_barang', $this->status_barang);
        }
        // if (!empty($this->asal_barang)) {
        //     $query->where('asal_id', $this->asal_barang);
        // }
        return view('livewire.laporan.laporan-status-barang', [
            'barang' => $query->paginate(5),
            // 'asal' => Asal::all()
        ]);
    }
    public function filter()
    {
        $this->render();
    }

    public function printBarang()
    {
        // Terapkan filter yang sama seperti di render()
        $query = BarangInventaris::with(['jenisBarang', 'Asal']);

        // if (!empty($this->jns_brg_nama)) {
        //     $query->where('jns_brg_kode', $this->jns_brg_nama);
        // }
        if ($this->kondisi_barang !== '' && $this->kondisi_barang !== null) {
            $query->where('kondisi_barang', $this->kondisi_barang);
        }
        if ($this->status_barang !== '' && $this->status_barang !== null) {
            $query->where('status_barang', $this->status_barang);
        }
        // if (!empty($this->asal_barang)) {
        //     $query->where('asal_id', $this->asal_barang);
        // }

        $barangs = $query->get();

        $kondisiMapping = [
            0 => 'Dihapus dari sistem',
            1 => 'Baik',
            2 => 'Rusak, bisa diperbaiki',
            3 => 'Rusak, tidak bisa digunakan',
        ];
        $statuMapping = [
            0 => 'Tidak Tersedia',
            1 => 'Tersedia',
        ];

        // Buat PDF dengan data yang difilter
        $pdf = Pdf::loadView('livewire.laporan.export-pdf-status-barang', compact('barangs', 'kondisiMapping', 'statuMapping'))
            ->setPaper('a4', 'landscape'); // Ubah ke landscape

        // Download PDF
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'laporan_barang_' . now()->format('YmdHis') . '.pdf');
    }
    public function exportExcel()
    {
        $filters = [
            'kondisi_barang' => $this->kondisi_barang,
            'status_barang' => $this->status_barang,
        ];

        return Excel::download(new StatusBarangExport($filters), 'laporan_status_barang_' . now()->format('YmdHis') . '.xlsx');
    }
}
