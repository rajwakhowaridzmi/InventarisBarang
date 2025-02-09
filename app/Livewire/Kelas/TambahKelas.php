<?php

namespace App\Livewire\Kelas;

use App\Models\Jurusan;
use Livewire\Component;
use App\Models\Kelas;

class TambahKelas extends Component
{
    public $jurusan_id;
    public $tingkat;
    public $no_kosentrasi;
    public function render()
    {
        $jurusans = Jurusan::all();
        return view('livewire.kelas.tambah-kelas', [
            'jurusans' => $jurusans,
        ]);
    }

    public function store(){
        $this->validate([
            'jurusan_id' => 'required|exists:jurusan,jurusan_id',
            'tingkat' => 'required|in:X,XI,XII',
           'no_kosentrasi' => 'required|string|max:2|regex:/^\d+$/',
        ], [
            'jurusan_id.required' => 'Jurusan wajib dipilih.',
            'jurusan_id.exists' => 'Jurusan tidak valid.',
            'tingkat.required' => 'Tingkat wajib dipilih.',
            'tingkat.in' => 'Tingkat harus salah satu dari X, XI, atau XII.',
            'no_kosentrasi.required' => 'No konsentrasi harus diisi',
            'no_kosentrasi.max' => 'Nomor konsentrasi maksimal 2 karakter.',
            'no_kosentrasi.regex' => 'Nomor konsentrasi harus berupa angka.',
        ]);

        Kelas::create([
            'jurusan_id' => $this->jurusan_id,
            'tingkat' => $this->tingkat,
            'no_kosentrasi' => $this->no_kosentrasi,
        ]);

        session()->flash('success', 'Data kelas berhasil ditambahkan.');
        return redirect()->route('daftar-kelas');
    }
}
