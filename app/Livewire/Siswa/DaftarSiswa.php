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
    public function confirmDelete($siswa_id){
        $this->siswa_id = $siswa_id;
    }
    public function delete($siswa_id)
    {
        $siswa = Siswa::find($siswa_id);

        if ($siswa) {
            $siswa->delete();
            session()->flash('success', 'Data Siswa berhasil dihapus.');
        }

        $this->siswa_id = null;

        $this->dispatch('closeModal');
    }
}
