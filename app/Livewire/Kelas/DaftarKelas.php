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
    public function delete($kelas_id)
    {
        $jurusan = Kelas::find($kelas_id);

        if (!$jurusan) {
            session()->flash('error', 'Data jurusan tidak ditemukan.');
            return;
        }

        $jurusan->delete();

        session()->flash('success', 'Data jurusan berhasil dihapus.');
    }
}
