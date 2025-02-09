<?php

namespace App\Livewire\Siswa;

use App\Models\Siswa;
use Livewire\Component;

class DaftarSiswa extends Component
{
    public $siswa_id;
    public function render()
    {
        $siswas = Siswa::all(); 
        return view('livewire.siswa.daftar-siswa', ['siswa' => $siswas]);
    }
        public function delete($siswa_id)
        {
            $siswa = Siswa::find($siswa_id);

            if (!$siswa) {
                session()->flash('error', 'Siswa tidak ditemukan.');
                return;
            }
            $siswa->delete();

            session()->flash('success', 'Data jurusan berhasil dihapus.');
        }
}
