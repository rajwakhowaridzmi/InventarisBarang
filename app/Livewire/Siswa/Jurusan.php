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
    public function confirmDelete($jurusan_id)
    {
        $this->jurusan_id = $jurusan_id;
    }

    public function delete()
    {
        $jurusan = ModelsJurusan::find($this->jurusan_id);

        if ($jurusan) {
            $jurusan->delete();
            session()->flash('success', 'Data jurusan berhasil dihapus.');
        }

        // Reset ID setelah penghapusan
        $this->jurusan_id = null;

        // Tutup modal
        $this->dispatch('closeModal');
    }
}
