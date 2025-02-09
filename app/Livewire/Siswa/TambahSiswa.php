<?php

namespace App\Livewire\Siswa;

use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Component;

class TambahSiswa extends Component
{
    public $kelas_id;
    public $nama;
    public $nis;
    public $email;
    public $siswa_status;
    public function render()
    {
        $kelass = Kelas::all();
        return view('livewire.siswa.tambah-siswa', [
            'kelas' => $kelass
        ]);
    }
    public function store()
    {
        $this->validate([
            'kelas_id' => 'required|exists:kelas,kelas_id',
            'nama' => 'required|string|max:50',
            'nis' => 'required|string|unique:siswa,nis',
            'email' => 'required|string|unique:siswa,email',
            // 'siswa_status' => 'required|in:0,1',
        ], [
            'kelas_id.required' => 'Kelas wajib dipilih.',
            // 'kelas_id.exists' => 'Kelas tidak valid.',
            'nama.required' => 'Nama siswa harus diisi.',
            'nis.required' => 'NIS harus diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            // 'siswa_status.required' => 'Status harus dipilih.',
            // 'status.in' => 'Status yang dipilih tidak valid.',
        ]);

        Siswa::create([
            'kelas_id' => $this->kelas_id,
            'nama' => $this->nama,
            'nis' => $this->nis,
            'email' => $this->email,
            'siswa_status' => '1',
        ]);

        session()->flash('success', 'Data siswa berhasil ditambahkan.');
        return redirect()->route('daftar-siswa');
    }
}
