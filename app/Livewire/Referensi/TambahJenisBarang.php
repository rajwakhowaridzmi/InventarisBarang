<?php

namespace App\Livewire\Referensi;

use App\Models\JenisBarang;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TambahJenisBarang extends Component
{
    public $jns_brg_nama;

    protected $rules = [
        'jns_brg_nama' => 'required|string|max:50',
    ];

    public function store()
    {
        $this->validate();

        // Ambil nomor urut terakhir
        $noUrutBaru = DB::table('jenis_barang')
            ->select(DB::raw("IFNULL(MAX(SUBSTRING(jns_brg_kode, 3, 4)), 0) + 1 AS no_urut"))
            ->value('no_urut');

        // Format nomor urut menjadi 4 digit
        $noUrutBaru = str_pad($noUrutBaru, 4, '0', STR_PAD_LEFT);

        // Generate kode barang
        $kodeJenisBarang = "JB" . $noUrutBaru;

        // Simpan data ke database
        DB::table('jenis_barang')->insert([
            'jns_brg_kode' => $kodeJenisBarang,
            'jns_brg_nama' => $this->jns_brg_nama,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('success', 'Jenis barang berhasil ditambahkan');
        return redirect()->route('daftar-jenis-barang');
    }

    public function render()
    {
        return view('livewire.referensi.tambah-jenis-barang');
    }
}
