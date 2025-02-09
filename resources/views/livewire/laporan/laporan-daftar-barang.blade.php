@php
$kondisiMapping = [
0 => 'Dihapus dari sistem',
1 => 'Baik',
2 => 'Rusak, bisa diperbaiki',
3 => 'Rusak, tidak bisa digunakan',
];
$statuMapping = [
0 => 'Tidak Tersedia',
1 => 'Tersedia'
];
@endphp
<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Laporan Barang</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Blank</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Laporan Daftar Barang</h5>
                                <div>
                                    <button class="btn btn-primary" wire:click="printBarang"><i class="bi bi-file-earmark-pdf-fill"></i> Export PDF</button>
                                    <button class="btn btn-success" wire:click="exportExcel"><i class="bi bi-file-excel-fill me-1"></i>Export Excel</button>
                                </div>
                            </div>

                            <div class="row mb-3 d-flex align-items-center">
                                <!-- Dropdown Jenis Barang -->
                                <div class="col-md-3">
                                    <select wire:model="jns_brg_nama" class="form-select">
                                        <option value="">Semua Jenis Barang</option>
                                        @foreach($jenisBarangList as $jenis)
                                        <option value="{{ $jenis->jns_brg_kode }}">{{ $jenis->jns_brg_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Dropdown Kondisi Barang -->
                                <div class="col-md-3">
                                    <select wire:model="kondisi_barang" class="form-select">
                                        <option value="">Semua Kondisi</option>
                                        <option value="1">Baik</option>
                                        <option value="2">Rusak, bisa diperbaiki</option>
                                        <option value="3">Rusak, tidak bisa digunakan</option>
                                    </select>
                                </div>

                                <!-- Dropdown Status Barang -->
                                <div class="col-md-3">
                                    <select wire:model="status_barang" class="form-select">
                                        <option value="">Semua Status</option>
                                        <option value="1">Tersedia</option>
                                        <option value="0">Tidak Tersedia</option>
                                    </select>
                                </div>

                                <!-- Dropdown Asal Barang -->
                                <div class="col-md-3">
                                    <select wire:model="asal_barang" class="form-select">
                                        <option value="">Semua Asal</option>
                                        @foreach($asal as $item)
                                        <option value="{{ $item->asal_id }}">{{ $item->asal_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tombol Filter -->
                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-primary w-100" wire:click="filter">Terapkan Filter</button>
                                </div>
                            </div>


                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode Barang</th>
                                        <th scope="col">Jenis Barang</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Tanggal Terima</th>
                                        <th scope="col">Tanggal Entry</th>
                                        <th scope="col">Kondisi Barang</th>
                                        <th scope="col">Status Barang</th>
                                        <th scope="col">Asal Barang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $loopIndex => $barangs)
                                    <tr>
                                        <td>{{ $barang->firstItem() + $loopIndex }}</td>
                                        <td>{{ $barangs->barang_kode ?? '-'}}</td>
                                        <td>{{ $barangs->jenisBarang->jns_brg_nama ?? '-'}}</td>
                                        <td>{{ $barangs->nama_barang ?? '-'}}</td>
                                        <td>{{ $barangs->tanggal_terima ?? '-'}}</td>
                                        <td>{{ $barangs->tanggal_entry ? \Carbon\Carbon::parse($barangs->tanggal_entry)->format('Y-m-d') : '-' }}</td>
                                        <td>{{ $kondisiMapping[$barangs->kondisi_barang] ?? '-' }}</td>
                                        <td>{{ $statuMapping[$barangs->status_barang] ?? '-'}}</td>
                                        <td>{{ $barangs->Asal->asal_barang ?? '-'}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mt-3">
                                {{ $barang->links('livewire.bootstrap-pagination') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>