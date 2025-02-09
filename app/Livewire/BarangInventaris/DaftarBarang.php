<?php

namespace App\Livewire\BarangInventaris;

use App\Models\BarangInventaris;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarBarang extends Component
{
    public $filterStatus = '';
    public $filterKondisi = '';
    public $filterJenis = '';
    use WithPagination;
    protected $paginationTheme = 'bootsrap';

    public function applyFilter()
    {
        $this->render();
    }

    public function render()
    {
        $barangs = BarangInventaris::query()
            ->when($this->filterStatus !== '', function ($query) {
                return $query->where('status_barang', $this->filterStatus);
            })
            ->when($this->filterKondisi !== '', function ($query): Builder {
                return $query->where('kondisi_barang', $this->filterKondisi);
            })
            // ->when($this->filterJenis !== '', function($query) : Builder {
            //     return $query->where('jns_brg_kode', $this->filterJenis);
            // })
            ->paginate(5);

        return view('livewire.barang-inventaris.daftar-barang', ['barang' => $barangs]);
    }
}
