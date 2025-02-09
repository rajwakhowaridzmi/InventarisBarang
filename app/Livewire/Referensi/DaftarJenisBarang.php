<?php

namespace App\Livewire\Referensi;

use App\Models\JenisBarang;
use Livewire\Component;

class DaftarJenisBarang extends Component
{
    public $jns_brg_kode;
    public function render()
    {
        $jenis_barangs= JenisBarang::all();

        return view('livewire.referensi.daftar-jenis-barang', ['jenis_barang' => $jenis_barangs]);
    }
    public function delete($jns_brg_kode){
        $jenis_barang = JenisBarang::find($jns_brg_kode);

        if (!$jenis_barang) {
            session()->flash('error', 'Jenis Barang tidak ditemukan.');
            return;
        }

        $jenis_barang->delete();

        session()->flash('success', 'Jenis Barang berhasil dihapus.');

    }
}
