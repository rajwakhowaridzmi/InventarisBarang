<?php

namespace App\Livewire\Siswa;

use App\Http\Controllers\JurusanController;
use App\Models\Jurusan as ModelsJurusan;
use Livewire\Component;


class Jurusan extends Component
{
    public $jurusan_id;
    public function render()
    {
        $jurusans = ModelsJurusan::get();

        return view('livewire.siswa.jurusan', ['jurusan' => $jurusans]);
    }
    public function delete($jurusan_id)
    {
        $jurusan = ModelsJurusan::find($jurusan_id);

        if (!$jurusan) {
            session()->flash('error', 'Data jurusan tidak ditemukan.');
            return;
        }

        $jurusan->delete();

        session()->flash('success', 'Data jurusan berhasil dihapus.');
    }
}
