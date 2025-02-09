<?php

namespace App\Livewire\Siswa;

use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Component;

class EditSiswa extends Component
{
    public $siswa_id;
    public $kelas_id;
    public $nama;
    public $nis;
    public $email;
    public $siswa_status;

    public function mount($siswa_id){
        $siswa = Siswa::find($siswa_id);
        if ($siswa) {
            $this->siswa_id = $siswa->siswa_id;
            $this->kelas_id = $siswa->kelas_id;
            $this->nama = $siswa->nama;
            $this->nis = $siswa->nis;
            $this->email = $siswa->email;
            $this->siswa_status = $siswa->siswa_status;
        } else {
            session()->flash('error', 'Siswa tidak ditemukan');
            return redirect()->route('daftar-siswa');
        }
    }
    public function render()
    {
        $kelass = Kelas::all();
        return view('livewire.siswa.edit-siswa', [
            'kelas' => $kelass
        ]);
    }
    
    public function update()
    {
        // Validasi input
        $this->validate([
            'kelas_id' => 'required|exists:kelas,kelas_id',
            'nama' => 'required|string|max:50',
            'nis' => 'required|string|unique:siswa,nis,' . $this->siswa_id . ',siswa_id',
            'email' => 'required|string|unique:siswa,email,' . $this->siswa_id . ',siswa_id',
            'siswa_status' => 'required|in:0,1',
        ], [
            'kelas_id.required' => 'Kelas wajib dipilih.',
            'nama.required' => 'Nama siswa harus diisi.',
            'nis.required' => 'NIS harus diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'siswa_status.required' => 'Status harus dipilih.',
        ]);

        $siswa = Siswa::find($this->siswa_id);
        $siswa->update([
            'kelas_id' => $this->kelas_id,
            'nama' => $this->nama,
            'nis' => $this->nis,
            'email' => $this->email,
            'siswa_status' => $this->siswa_status,
        ]);

        // Menampilkan pesan sukses
        session()->flash('success', 'Data siswa berhasil diperbarui.');
        return redirect()->route('daftar-siswa');
    }
}
