<?php

namespace App\Exports;

use App\Models\BarangInventaris;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithCustomStartCell
{
    public $filters;
    private $counter = 0; // Tambahkan properti counter

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = BarangInventaris::query()->with(['jenisBarang', 'Asal']);

        if (!empty($this->filters['jns_brg_nama'])) {
            $query->where('jns_brg_kode', $this->filters['jns_brg_nama']);
        }
        if ($this->filters['kondisi_barang'] !== '' && $this->filters['kondisi_barang'] !== null) {
            $query->where('kondisi_barang', $this->filters['kondisi_barang']);
        }
        if ($this->filters['status_barang'] !== '' && $this->filters['status_barang'] !== null) {
            $query->where('status_barang', $this->filters['status_barang']);
        }
        if (!empty($this->filters['asal_barang'])) {
            $query->where('asal_id', $this->filters['asal_barang']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode Barang',
            'Jenis Barang',
            'Nama Barang',
            'Tanggal Terima',
            'Tanggal Entry',
            'Kondisi Barang',
            'Status Barang',
            'Asal Barang',
        ];
    }

    public function map($row): array
    {
        $this->counter++; // Tambahkan nomor urut setiap baris

        return [
            $this->counter, // Nomor urut
            $row->barang_kode,
            $row->jenisBarang->jns_brg_nama ?? '-',
            $row->nama_barang,
            $row->tanggal_terima,
            $row->tanggal_entry,
            $this->mapKondisi($row->kondisi_barang),
            $this->mapStatus($row->status_barang),
            $row->Asal->asal_barang ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Tambahkan judul di baris 1
        $sheet->mergeCells('A1:I1'); // Merge dari kolom A sampai I
        $sheet->setCellValue('A1', 'Daftar Barang'); // Isi dengan judul

        // Style untuk judul
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ]);

        // Tambahkan border dan atur jarak
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // Tambahkan border untuk seluruh data
        $sheet->getStyle("A2:{$highestColumn}{$highestRow}")
            ->getBorders()->getAllBorders()->setBorderStyle('thin');

        // Atur heading dengan style bold dan background warna abu-abu
        $sheet->getStyle('A2:' . $highestColumn . '2')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => 'FFEEEEEE'], // Abu-abu muda
            ],
        ]);

        // Atur text align (center untuk nomor, left untuk lainnya)
        $sheet->getStyle('A2:A' . $highestRow)
            ->getAlignment()->setHorizontal('center');

        $sheet->getStyle('B2:' . $highestColumn . $highestRow)
            ->getAlignment()->setHorizontal('left');

        return [];
    }

    public function startCell(): string
    {
        return 'A2'; // Mulai header tabel di baris ke-2
    }

    private function mapKondisi($kondisi)
    {
        $mapping = [
            '0' => 'Dihapus Sistem',
            '1' => 'Baik',
            '2' => 'Rusak, bisa diperbaiki',
            '3' => 'Rusak, tidak bisa digunakan',
        ];

        return $mapping[$kondisi] ?? 'Tidak Diketahui';
    }

    private function mapStatus($status)
    {
        $mapping = [
            '0' => 'Tidak Tersedia',
            '1' => 'Tersedia',
        ];

        return $mapping[$status] ?? 'Tidak Diketahui';
    }
}
