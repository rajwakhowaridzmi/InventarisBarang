<div>
    @php
    $kondisiMapping = [
    0 => 'Dihapus dari sistem',
    1 => 'Baik',
    2 => 'Rusak, bisa diperbaiki',
    3 => 'Rusak, tidak bisa digunakan',
    ];
    $statusMapping = [
    0 => 'Dipinjam',
    1 => 'Dikembalikan'
    ];
    @endphp
    <div>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Daftar Barang</h1>
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
                                <h5 class="card-title">Daftar Barang</h5>
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <select id="statusFilter" class="form-select" wire:model="filterStatus">
                                            <option value="">Semua Status</option>
                                            <option value="0">Dipinjam</option>
                                            <option value="1">Dikembalikan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <select id="kondisiFilter" class="form-select" wire:model="filterKondisi">
                                            <option value="">Semua Kondisi</option>
                                            <option value="0">Dihapus dari sistem</option>
                                            <option value="1">Baik</option>
                                            <option value="2">Rusak, bisa diperbaiki</option>
                                            <option value="3">Rusak, tidak bisa digunakan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button class="btn btn-primary w-100" wire:click="applyFilter">Terapkan Filter</button>
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
                                            <th scope="col">Aksi</th>
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
                                            <td>{{ $barangs->tanggal_entry ?? '-'}}</td>
                                            <td>{{ $kondisiMapping[$barangs->kondisi_barang] ?? '-' }}</td>
                                            <td>{{ $statusMapping[$barangs->status_barang] ?? '-'}}</td>
                                            <td>{{ $barangs->Asal->asal_barang ?? '-'}}</td>
                                            <td>
                                                <a wire:navigate href="/edit-barang/{{ $barangs->barang_kode}}" class="bi bi-pencil-square fs-3"></a>
                                                <a wire:click="delete({{ $barangs->barang_kode }})" href="#" class="bi bi-trash fs-3" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"></a>
                                            </td>
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

</div>