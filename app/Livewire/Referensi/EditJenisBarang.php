<?php

namespace App\Livewire\Referensi;

use App\Models\JenisBarang;
use Livewire\Component;

class EditJenisBarang extends Component
{
    public $jns_brg_kode;
    public $jns_brg_nama;

    public function mount($jns_brg_kode)
    {
        $jenis_barang = JenisBarang::find($jns_brg_kode);

        if (!$jenis_barang) {
            session()->flash('error', 'Data tidak ditemukan');
            return redirect()->route('daftar-jenis-barang');
        }
        $this->jns_brg_kode = $jenis_barang->jns_brg_kode;
        $this->jns_brg_nama = $jenis_barang->jns_brg_nama;
    }
    public function render()
    {
        return view('livewire.referensi.edit-jenis-barang');
    }
    public function update()
    {
        $this->validate([
            'jns_brg_kode' => 'required|string|max:10',
            'jns_brg_nama' => 'required|string|max:50',
        ], [
            'jns_brg_kode.required' => 'Kode jenis barang tidak boleh kosong',
            'jns_brg_kode.max' => 'Kode jenis barang tidak boleh lebih dari 10 karakter',
            'jns_brg_nama.required' => 'Nama jenis barang tidak boleh kosong',
            'jns_brg_nama.max' => 'Nama jenis barang tidak boleh lebih dari 50 karakter',
        ]);

        $jenis_barang = JenisBarang::find($this->jns_brg_kode);

        if (!$jenis_barang) {
            session()->flash('error', 'Jenis Barang tidak ditemukan');
            return redirect()->route('daftar-jenis-barang');
        }

        $jenis_barang->update([
            'jns_brg_kode' => $this->jns_brg_kode,
            'jns_brg_nama' => $this->jns_brg_nama,
        ]);

        session()->flash('success', 'Jenis Barang berhasil diperbarui');
        return redirect()->route('daftar-jenis-barang');
    }
}

