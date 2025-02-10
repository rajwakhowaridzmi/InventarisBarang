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
    public function confirmDelete($jns_brg_kode)
    {
        $this->jns_brg_kode = $jns_brg_kode;
    }
    public function delete(){
        
        $jenis_barang = JenisBarang::find($this->jns_brg_kode);

        if ($jenis_barang) {
            $jenis_barang->delete();
            session()->flash('success', 'Jenis Barang berhasil dihapus.');
        }

        // Reset ID setelah penghapusan
        $this->jns_brg_kode = null;

        // Tutup modal
        $this->dispatch('closeModal');
    }
}
