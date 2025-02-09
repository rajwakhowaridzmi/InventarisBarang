<?php

namespace App\Livewire\BarangInventaris;

use App\Models\Asal;
use App\Models\JenisBarang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TambahBarang extends Component
{
    public $nama_barang;
    public $jns_brg_kode;
    public $tanggal_terima;
    public $kondisi_barang;
    public $asal_id;

    protected $rules = [
        'nama_barang' => 'required|string|max:50',
        'jns_brg_kode' => 'required|exists:jenis_barang,jns_brg_kode',
        'tanggal_terima' => 'required|date',
        'kondisi_barang' => 'required|in:0,1,2,3',
        'asal_id' => 'required|exists:asal,asal_id',
    ];

    public function store()
    {
        $this->validate();

        $tahunSekarang = date('Y');

        $noUrutBaru = DB::table('barang_inventaris')
            ->select(DB::raw("IFNULL(MAX(SUBSTRING(barang_kode, 8, 5)), 0) + 1 AS no_urut"))
            ->where(DB::raw("SUBSTRING(barang_kode, 4, 4)"), $tahunSekarang)
            ->value('no_urut');

        $noUrutBaru = str_pad($noUrutBaru, 5, '0', STR_PAD_LEFT);

        $barangKode = "INV" . $tahunSekarang . $noUrutBaru;

        $user_id = Auth::user()->user_id;

        DB::table('barang_inventaris')->insert([
            'barang_kode' => $barangKode,
            'jns_brg_kode' => $this->jns_brg_kode,
            'user_id' => $user_id,
            'nama_barang' => $this->nama_barang,
            'tanggal_terima' => $this->tanggal_terima,
            'tanggal_entry' => now()->format('Y-m-d'),
            'kondisi_barang' => $this->kondisi_barang,
            'status_barang' => '1',
            'asal_id' => $this->asal_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('message', 'Barang berhasil ditambahkan');
        return redirect()->route('daftar-barang');
    }

    public function render()
    {
        $asals = Asal::all();
        $jenis_barangs = JenisBarang::all();
        return view('livewire.barang-inventaris.tambah-barang', ['jenis_barang' => $jenis_barangs, 'asal' => $asals]);
    }
}
