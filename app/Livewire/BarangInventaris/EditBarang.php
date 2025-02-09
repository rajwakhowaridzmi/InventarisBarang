<?php

namespace App\Livewire\BarangInventaris;

use App\Models\Asal;
use App\Models\BarangInventaris;
use App\Models\JenisBarang;
use Livewire\Component;

class EditBarang extends Component
{
    public $barang_kode;
    public $nama_barang;
    public $jns_brg_kode;
    public $tanggal_terima;
    public $tanggal_entry;
    public $kondisi_barang;
    public $status_barang;
    public $asal_id;
    public function mount($barang_kode)
    {
        $barang = BarangInventaris::where('barang_kode', $barang_kode)->first();

        if (!$barang) {
            session()->flash('error', 'Data barang tidak ditemukan.');
            return redirect()->route('daftar-barang'); // Redirect jika tidak ditemukan
        }

        $this->barang_kode = $barang->barang_kode;
        $this->nama_barang = $barang->nama_barang;
        $this->jns_brg_kode = $barang->jns_brg_kode;
        $this->tanggal_terima = $barang->tanggal_terima;
        $this->tanggal_entry = $barang->tanggal_entry;
        $this->kondisi_barang = $barang->kondisi_barang;
        $this->status_barang = $barang->status_barang;
        $this->asal_id = $barang->asal_id;
    }

    public function render()
    {
        $asals = Asal::all();
        $jenis_barangs = JenisBarang::all();
        return view('livewire.barang-inventaris.edit-barang', ['jenis_barang' => $jenis_barangs, 'asal' => $asals]);
    }

    public function update()
    {
        $this->validate([
            'nama_barang' => 'required|string|max:50',
            'jns_brg_kode' => 'required|exists:jenis_barang,jns_brg_kode',
            'tanggal_terima' => 'required|date',
            'tanggal_entry' => 'required|date',
            'kondisi_barang' => 'required|in:0,1,2,3',
            'status_barang' => 'required|in:0,1',
            'asal_id' => 'required|exists:asal,asal_id',
        ], [
            'nama_barang.required' => 'Nama barang tidak boleh kosong.',
            'nama_barang.max' => 'Nama barang tidak boleh lebih dari 50 karakter.',
            'jns_brg_kode.required' => 'Jenis barang wajib dipilih.',
            'tanggal_terima.required' => 'Tanggal terima wajib diisi.',
            'tanggal_entry.required' => 'Tanggal entry wajib diisi.',
            'kondisi_barang.in' => 'Kondisi barang tidak valid.',
            'status_barang.in' => 'Status barang tidak valid.',
            'asal_id.required' => 'Asal barang wajib dipilih.',
        ]);

        $barang = BarangInventaris::where('barang_kode', $this->barang_kode)->first();

        if (!$barang) {
            session()->flash('error', 'Data barang tidak ditemukan.');
            return redirect()->route('daftar-barang'); // Redirect jika tidak ditemukan
        }

        $barang->update([
            'nama_barang' => $this->nama_barang,
            'jns_brg_kode' => $this->jns_brg_kode,
            'tanggal_terima' => $this->tanggal_terima,
            'tanggal_entry' => $this->tanggal_entry,
            'kondisi_barang' => $this->kondisi_barang,
            'status_barang' => $this->status_barang,
            'asal_id' => $this->asal_id,
        ]);

        session()->flash('success', 'Data barang berhasil diupdate.');
        return redirect()->route('daftar-barang');
    }
}
