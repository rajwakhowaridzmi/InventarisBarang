<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Jurusa;

class EditJurusan extends Component
{
    public $jurusan_id;
    public $nama_jurusan;

    // Mount data saat inisialisasi
    public function mount($jurusan_id)
    {
        $jurusan = Jurusan::find($jurusan_id);

        if (!$jurusan) {
            session()->flash('error', 'Data jurusan tidak ditemukan.');
            return redirect()->route('jurusan'); // Redirect jika tidak ditemukan
        }

        $this->jurusan_id = $jurusan->jurusan_id;
        $this->nama_jurusan = $jurusan->nama_jurusan;
    }

    public function render()
    {
        return view('livewire.siswa.edit-jurusan');
    }
    public function update()
    {
        $this->validate([
            'nama_jurusan' => 'required|string|max:50',
        ], [
            'nama_jurusan.required' => 'Nama jurusan tidak boleh kosong.',
            'nama_jurusan.max' => 'Nama jurusan tidak boleh lebih dari 50 karakter.',
        ]);

        $jurusan = Jurusan::find($this->jurusan_id);

        if (!$jurusan) {
            session()->flash('error', 'Data jurusan tidak ditemukan.');
            return redirect()->route('jurusan'); // Redirect jika tidak ditemukan
        }

        $jurusan->update([
            'nama_jurusan' => $this->nama_jurusan,
        ]);

        session()->flash('success', 'Data jurusan berhasil diupdate.');
        return redirect()->route('jurusan');
    }
}
