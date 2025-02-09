<div>
    @php
    $statusMapping = [
    0 => 'Dihapus Sistem',
    1 => 'Peminjaman Aktif'
    ];
    @endphp
    <div>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Peminjaman</h1>
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
                                    <h5 class="card-title">Riwayat Transaksi Peminjaman</h5>
                                </div>
                                <div class="row g-3 align-items-center mb-3">
                                    <div class="col-md-4">
                                        <input
                                            type="date"
                                            id="filterTanggal"
                                            class="form-control py-2"
                                            wire:model.defer="filterTanggal" />
                                    </div>
                                    <div class="col-md-4">
                                        <select
                                            id="filterStatus"
                                            class="form-control py-2"
                                            wire:model.defer="filterStatus">
                                            <option value="">Semua</option>
                                            <option value="0">Dihapus Sistem</option>
                                            <option value="1">Peminjaman Aktif</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 d-flex gap-2 justify-content-md-end">
                                        <button
                                            class="btn btn-outline-primary w-100 w-md-auto"
                                            wire:click="filterData">
                                            Terapkan Filter
                                        </button>
                                        <button
                                            class="btn btn-primary w-100 w-md-auto"
                                            wire:navigate href="/tambah-peminjaman">
                                            Tambah Transaksi
                                        </button>
                                    </div>
                                </div>

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <!-- <th scope="col">ID Transaksi</th> -->
                                            <th scope="col">Peminjam</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Tanggal Pinjam</th>
                                            <th scope="col">Batas Peminjaman</th>
                                            <th scope="col">Status Peminjaman</th>
                                            <th scope="col">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjaman as $index => $peminjamans)
                                        <tr>
                                            <th scope="row">{{ $peminjaman->firstItem() + $index }}</th>
                                            <!-- <td>{{ $peminjamans->peminjaman_id ?? '-'}}</td> -->
                                            <td>{{ $peminjamans->siswa->nama }}</td>
                                            <td>{{ $peminjamans->siswa->kelas->tingkat }}
                                                {{ $peminjamans->siswa->kelas->jurusan->nama_jurusan }}
                                                {{ $peminjamans->siswa->kelas->no_kosentrasi }}
                                            </td>
                                            <td>{{ $peminjamans->tanggal_pinjam ?? '-'}}</td>
                                            <td>{{ $peminjamans->harus_kembali_tgl ?? '-'}}</td>
                                            <td>{{ $statusMapping[$peminjamans->peminjaman_status] ?? '-'}}</td>
                                            <td>
                                                <a wire:navigate href="/detail-peminjaman/{{ $peminjamans->peminjaman_id}}" class="bi bi-pencil-square fs-3"></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-end mt-3">
                                    {{ $peminjaman->links('livewire.bootstrap-pagination') }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>