<?php

namespace App\Livewire\PeminjamanBarang;

use App\Models\BarangInventaris;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TambahPeminjaman extends Component
{

    public $siswa_id;
    public $siswa = [];
    public $tanggal_pinjam;
    public $harus_kembali_tgl;
    public $peminjaman_status;
    public $user_id;
    public $user_nama;

    public $barang_kode = [], $status_pmj, $tanggal_entry;
    public $barang = [];
    public $searchQuery = '';
    public $searchSiswa = '';
    public $filteredSiswa = [];
    public $selectedSiswa = '';

    public $kelas_siswa = '';
    public function mount()
    {
        $this->user_id = Auth::user()->user_id;

        $this->user_nama = DB::table('user')
            ->where('user_id', $this->user_id)
            ->value('user_nama');

        $this->siswa = Siswa::with(['kelas.jurusan'])
            ->where('siswa_status', 1)
            ->get();

        $this->barang = BarangInventaris::where('status_barang', '1')->get();
    }

    public function tambahBarang($kodeBarang)
    {
        if (!in_array($kodeBarang, $this->barang_kode)) {
            $this->barang_kode[] = $kodeBarang;
        }
    }

    public function kurangBarang($kodeBarang)
    {
        $this->barang_kode = array_diff($this->barang_kode, [$kodeBarang]);
    }
    public function updatedSearchQuery()
    {
        // Perbarui data barang setiap kali searchQuery berubah
        $this->barang = BarangInventaris::where('status_barang', '1')
            ->where('nama_barang', 'like', '%' . $this->searchQuery . '%')
            ->get();
    }
    public function updatedSearchSiswa()
    {
        if (!empty($this->searchSiswa)) {
            $this->filteredSiswa = Siswa::with(['kelas.jurusan'])
                ->where('nama', 'like', '%' . $this->searchSiswa . '%')
                ->whereDoesntHave('peminjaman', function ($query) {
                    $query->where('peminjaman_status', '1'); // Status 1 = aktif
                })
                ->get();
        } else {
            $this->filteredSiswa = []; // Kosongkan hasil pencarian jika input kosong
        }
    }
    

    public function selectSiswa($id, $nama)
    {
        $this->siswa_id = $id;
        $siswa = Siswa::with('kelas.jurusan')->find($id);
    
        if ($siswa) {
            $kelas = "{$siswa->kelas->tingkat} {$siswa->kelas->jurusan->nama_jurusan} {$siswa->kelas->no_kosentrasi}";
            $this->selectedSiswa = "{$nama} - {$kelas}"; // Gabungkan nama dan kelas
        }
    
        $this->searchSiswa = $this->selectedSiswa; // Tampilkan di input
        $this->filteredSiswa = []; // Kosongkan dropdown setelah memilih
    }
    
    public function resetSiswa()
    {
        $this->siswa_id = null;
        $this->searchSiswa = '';
        $this->filteredSiswa = [];
        $this->kelas_siswa = '';    
    }

    public function store()
    {
        try {
            $this->validate([
                'siswa_id' => 'required|exists:siswa,siswa_id',
                'harus_kembali_tgl' => 'required|date|after_or_equal:tanggal_pinjam',
                'barang_kode' => 'required|array',
                'barang_kode.*' => 'exists:barang_inventaris,barang_kode',
            ]);

            // Generate nomor urut peminjaman
            $tahunSekarang = date('Y');
            $bulanSekarang = date('m');

            $noUrutBaru = DB::table('peminjaman')
                ->select(DB::raw("IFNULL(MAX(SUBSTRING(peminjaman_id, 7, 4)), 0) + 1 AS no_urut"))
                ->where(DB::raw("SUBSTRING(peminjaman_id, 3, 4)"), $tahunSekarang)
                ->where(DB::raw("SUBSTRING(peminjaman_id, 5, 2)"), $bulanSekarang)
                ->value('no_urut');

            $noUrutBaru = str_pad($noUrutBaru, 4, '0', STR_PAD_LEFT);
            $peminjamanId = "PJ" . $tahunSekarang . $bulanSekarang . $noUrutBaru;

            while (DB::table('peminjaman')->where('peminjaman_id', $peminjamanId)->exists()) {
                $noUrutBaru++;
                $noUrutBaru = str_pad($noUrutBaru, 4, '0', STR_PAD_LEFT);
                $peminjamanId = "PJ" . $tahunSekarang . $bulanSekarang . $noUrutBaru;
            }

            // Simpan data peminjaman
            DB::table('peminjaman')->insert([
                'peminjaman_id' => $peminjamanId,
                'siswa_id' => $this->siswa_id,
                'user_id' => $this->user_id,
                'tanggal_pinjam' => now()->format('Y-m-d'),
                'harus_kembali_tgl' => $this->harus_kembali_tgl,
                'peminjaman_status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Simpan barang yang dipinjam
            foreach ($this->barang_kode as $kode) {
                $barangUrut = DB::table('peminjaman_barang')
                    ->select(DB::raw("IFNULL(MAX(CAST(SUBSTRING(pjm_barang_id, 12, 3) AS UNSIGNED)), 0) + 1 AS no_urut"))
                    ->where(DB::raw("SUBSTRING(pjm_barang_id, 1, 10)"), $peminjamanId)
                    ->value('no_urut');

                $barangUrut = str_pad($barangUrut, 3, '0', STR_PAD_LEFT);
                $pjm_barang_id = "{$peminjamanId}{$barangUrut}";

                while (DB::table('peminjaman_barang')->where('pjm_barang_id', $pjm_barang_id)->exists()) {
                    $barangUrut++;
                    $barangUrut = str_pad($barangUrut, 3, '0', STR_PAD_LEFT);
                    $pjm_barang_id = "{$peminjamanId}{$barangUrut}";
                }

                DB::table('peminjaman_barang')->insert([
                    'pjm_barang_id' => $pjm_barang_id,
                    'peminjaman_id' => $peminjamanId,
                    'barang_kode' => $kode,
                    'status_pmj' => '1',
                    'tanggal_entry' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('barang_inventaris')
                    ->where('barang_kode', $kode)
                    ->update(['status_barang' => '0']);
            }

            session()->flash('message', 'Peminjaman dan barang berhasil ditambahkan!');
            return redirect()->route('daftar-peminjaman');
        } catch (\Exception $e) {
            // Menangkap error dan menampilkan pesan error
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function render()
    {
        return view('livewire.peminjaman-barang.tambah-peminjaman', [
            'siswa' => Siswa::all(),
            'barang' => $this->barang
        ]);
    }
}
