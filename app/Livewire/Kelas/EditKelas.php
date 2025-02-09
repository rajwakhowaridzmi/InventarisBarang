<?php

namespace App\Livewire\Kelas;

use Livewire\Component;
use App\Models\Kelas;
use App\Models\Jurusan;

class EditKelas extends Component
{
    public $kelas_id;
    public $jurusan_id;
    public $tingkat;
    public $no_kosentrasi;
    public function mount($kelas_id)
    {
        $kelas = Kelas::find($kelas_id);

        $this->kelas_id = $kelas->kelas_id;
        $this->jurusan_id = $kelas->jurusan_id;
        $this->tingkat = $kelas->tingkat;
        $this->no_kosentrasi = $kelas->no_kosentrasi;
    }
    public function render()
    {
        $jurusans = Jurusan::all();

        return view('livewire.kelas.edit-kelas', [
            'jurusans' => $jurusans,
        ]);
    }
    public function update()
    {
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

        $kelas = Kelas::find($this->kelas_id);

        $kelas->update([
            'jurusan_id' => $this->jurusan_id,
            'tingkat' => $this->tingkat,
            'no_kosentrasi' => $this->no_kosentrasi,
        ]);

        session()->flash('success', 'Data kelas berhasil diperbarui.');
        return redirect()->route('daftar-kelas');
    }
}
