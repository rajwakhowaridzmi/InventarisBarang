<?php

namespace App\Livewire\PeminjamanBarang;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditPengembalian extends Component
{
    public $pengembalian_id;
    public $peminjaman_id;
    public $tanggal_kembali;
    public $kembali_status;
    public $user_id;
    public $user_nama;
    public function mount($pengembalian_id)
    {
        // Ambil data pengembalian yang ingin diubah
        $pengembalian = DB::table('pengembalian')
            ->where('pengembalian_id', $pengembalian_id)
            ->first();

        if ($pengembalian) {
            $this->pengembalian_id = $pengembalian->pengembalian_id;
            $this->peminjaman_id = $pengembalian->peminjaman_id;
            $this->tanggal_kembali = $pengembalian->tanggal_kembali;
            $this->kembali_status = $pengembalian->kembali_status;
            $this->user_id = $pengembalian->user_id;

            $this->user_nama = DB::table('user')->where('user_id', $pengembalian->user_id)->value('user_nama');
        }
    }
    public function update()
    {
        // Validasi input
        $this->validate([
            'peminjaman_id' => 'required|exists:peminjaman,peminjaman_id',
            'tanggal_kembali' => 'required|date',
            'kembali_status' => 'required|in:0,1',
        ]);

        // Update data pengembalian
        DB::table('pengembalian')->where('pengembalian_id', $this->pengembalian_id)->update([
            'peminjaman_id' => $this->peminjaman_id,
            'tanggal_kembali' => $this->tanggal_kembali,
            'kembali_status' => $this->kembali_status,
            'user_id' => $this->user_id,
            'updated_at' => now(),
        ]);

        session()->flash('message', 'Pengembalian berhasil diperbarui');
        return redirect()->route('daftar-pengembalian');
    }

    public function render()
    {
        $peminjamans = Peminjaman::all();
        return view('livewire.peminjaman-barang.edit-pengembalian', ['peminjaman' => $peminjamans]);
    }
}
