<?php

namespace App\Livewire\Siswa;

use App\Models\Jurusan;
use Livewire\Component;

class TambahJurusan extends Component
{
    public $nama_jurusan;

    public function render()
    {
        return view('livewire.siswa.tambah-jurusan');
    }

    public function store()
    {
        $this->validate([
            'nama_jurusan' => 'required|string|max:50',
        ], [
            'nama_jurusan.required' => 'Nama jurusan tidak boleh kosong.',
            'nama_jurusan.max' => 'Nama jurusan tidak boleh lebih dari 50 karakter.',
        ]);
        
        Jurusan::create([
            'nama_jurusan' => $this->nama_jurusan,
        ]);

        session()->flash('success', 'Data Berhasil ditambahkan');
        return redirect()->route('jurusan');
    }
}
