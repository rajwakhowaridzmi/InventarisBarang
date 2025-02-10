<?php

namespace App\Livewire\Kelas;

use Livewire\Component;
use App\Models\Kelas;

class DaftarKelas extends Component
{
    public $kelas_id;
    // public $jurusan_id;
    // public $tingkat;
    // public $no_kosentrasi;
    public function render()
    {
        $kelass = Kelas::get();
        return view('livewire.kelas.daftar-kelas', ['kelas' => $kelass]);
    }
    public function confirmDelete($kelas_id){
        $this->kelas_id = $kelas_id;
    }
    public function delete($kelas_id)
    {
        $kelas = Kelas::find($kelas_id);

        if ($kelas) {
            $kelas->delete();
            session()->flash('success', 'Data Kelas berhasil dihapus.');
        }

       $this->kelas_id = null;

        $this->dispatch('closeModal');
    }
}
