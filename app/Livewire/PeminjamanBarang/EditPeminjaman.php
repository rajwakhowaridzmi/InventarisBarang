<?php

namespace App\Livewire\PeminjamanBarang;

use App\Models\Peminjaman;
use App\Models\Siswa;
use Livewire\Component;

class EditPeminjaman extends Component
{
    public $peminjaman_id;
    public $siswa_id;
    public $user_id;
    public $tanggal_pinjam;
    public $harus_kembali_tgl;
    public $peminjaman_status;
    // public $siswa;
    public $user_nama;
    public function mount($peminjaman_id)
    {
        $peminjaman = Peminjaman::where('peminjaman_id', $peminjaman_id)->with('siswa', 'user')->first();

        if (!$peminjaman) {
            session()->flash('error', 'Data peminjaman tidak ditemukan.');
            return redirect()->route('daftar-peminjaman'); // Redirect jika tidak ditemukan
        }

        $this->peminjaman_id = $peminjaman->peminjaman_id;
        $this->siswa_id = $peminjaman->siswa_id;
        $this->user_id = $peminjaman->user_id;
        $this->tanggal_pinjam = $peminjaman->tanggal_pinjam;
        $this->harus_kembali_tgl = $peminjaman->harus_kembali_tgl;
        $this->peminjaman_status = $peminjaman->peminjaman_status;
        $this->user_nama = $peminjaman->user->user_nama ?? '-';
    }

    public function render()
    {
        $siswas = Siswa::all();
        return view('livewire.peminjaman-barang.edit-peminjaman' , [
            'siswa' => $siswas
        ]);
    }

    public function update()
    {
        $this->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'tanggal_pinjam' => 'required|date',
            'harus_kembali_tgl' => 'required|date|after_or_equal:tanggal_pinjam',
            'peminjaman_status' => 'required|in:0,1',
        ], [
            'siswa_id.required' => 'Siswa wajib dipilih.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
            'harus_kembali_tgl.required' => 'Tanggal kembali wajib diisi.',
            'harus_kembali_tgl.after_or_equal' => 'Tanggal kembali harus sama atau setelah tanggal pinjam.',
            'peminjaman_status.in' => 'Status peminjaman tidak valid.',
        ]);

        $peminjaman = Peminjaman::where('peminjaman_id', $this->peminjaman_id)->first();

        if (!$peminjaman) {
            session()->flash('error', 'Data peminjaman tidak ditemukan.');
            return redirect()->route('daftar-peminjaman'); // Redirect jika tidak ditemukan
        }

        $peminjaman->update([
            'siswa_id' => $this->siswa_id,
            'user_id' => $this->user_id,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'harus_kembali_tgl' => $this->harus_kembali_tgl,
            'peminjaman_status' => $this->peminjaman_status,
        ]);

        session()->flash('success', 'Data peminjaman berhasil diupdate.');
        return redirect()->route('daftar-peminjaman');
    }
}
