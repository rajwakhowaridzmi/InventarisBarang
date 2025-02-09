<div>
    @php
    $statusMapping = [
    0 => 'Barang Sudah Dikembalikan',
    1 => 'Barang Sedang Dipinjam'
    ];
    @endphp
    <div>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Pengembalian</h1>
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
                                    <h5 class="card-title">Barang Belum Kembali</h5>
                                    <!-- <button class="btn btn-primary" wire:navigate href="/tambah-pengembalian-barang">Tambah Pengembalian</button> -->
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <!-- <th scope="col">ID Peminjaman Barang</th> -->
                                            <th scope="col">ID Transaksi</th>
                                            <th scope="col">Peminjam</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Barang Kode</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Tanggal Peminjaman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengembalian_barang as $loopIndex => $pengembalian_barangs)
                                        <tr>
                                            <th scope="row">{{ $pengembalian_barang->firstItem() + $loopIndex }}</th>
                                            <!-- <td>{{ $pengembalian_barangs->pjm_barang_id ?? '-'}}</td> -->
                                            <td>{{ $pengembalian_barangs->peminjaman->peminjaman_id ?? '-'}}</td>
                                            <td>{{ $pengembalian_barangs->peminjaman->siswa->nama ?? '-' }}</td>
                                            <td>
                                                {{ $pengembalian_barangs->peminjaman->siswa->kelas->tingkat ?? '-' }}
                                                {{ $pengembalian_barangs->peminjaman->siswa->kelas->jurusan->nama_jurusan ?? '-' }}
                                                {{ $pengembalian_barangs->peminjaman->siswa->kelas->no_kosentrasi ?? '-' }}
                                            </td>
                                            <td>{{ $pengembalian_barangs->barang_kode ?? '-'}}</td>
                                            <td>{{ $pengembalian_barangs->barangInventaris->nama_barang ?? '-' }}</td>
                                            <td>{{ $pengembalian_barangs->tanggal_entry ?? '-'}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $pengembalian_barang->links('livewire.bootstrap-pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>