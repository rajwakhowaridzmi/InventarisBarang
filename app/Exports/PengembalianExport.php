<?php

namespace App\Exports;

use App\Models\Pengembalian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PengembalianExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithCustomStartCell
{
    private $counter = 0; // Nomor urut otomatis

    public function collection()
    {
        return Pengembalian::with(['peminjaman.siswa.kelas.jurusan'])->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'ID Pengembalian',
            'ID Transaksi',
            'Nama Peminjam',
            'Kelas',
            'Tanggal Kembali'
        ];
    }

    public function map($pengembalian): array
    {
        $this->counter++;

        return [
            $this->counter, // Nomor urut
            $pengembalian->pengembalian_id,
            $pengembalian->peminjaman->peminjaman_id ?? '-',
            $pengembalian->peminjaman->siswa->nama ?? '-',
            ($pengembalian->peminjaman->siswa->kelas->tingkat ?? '-') . ' ' .
            ($pengembalian->peminjaman->siswa->kelas->jurusan->nama_jurusan ?? '-') . ' ' .
            ($pengembalian->peminjaman->siswa->kelas->no_kosentrasi ?? '-'),
            $pengembalian->tanggal_kembali ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Tambahkan judul di baris 1
        $sheet->mergeCells('A1:F1'); // Merge dari kolom A sampai F
        $sheet->setCellValue('A1', 'Daftar Pengembalian'); // Isi dengan judul

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

        // Tambahkan border dan atur style heading
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // Tambahkan border untuk seluruh data
        $sheet->getStyle("A2:{$highestColumn}{$highestRow}")
            ->getBorders()->getAllBorders()->setBorderStyle('thin');

        // Atur heading dengan style bold dan background warna abu-abu muda
        $sheet->getStyle('A2:' . $highestColumn . '2')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => 'FFEEEEEE'], // Abu-abu muda
            ],
        ]);

        // Atur text alignment (center untuk nomor, left untuk lainnya)
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
}
