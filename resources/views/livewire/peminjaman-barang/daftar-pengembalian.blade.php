<div>
    @php
    $statusMapping = [
    0 => 'Belum Kembali',
    1 => 'Dikembalikan'
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
                                    <h5 class="card-title">Riwayat Pengembalian</h5>
                                    <button class="btn btn-primary" wire:navigate href="/tambah-pengembalian">Tambah Pengembalian</button>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ID Pengembalian</th>
                                            <th scope="col">ID Transaksi</th>
                                            <th scope="col">Peminjam</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Tanggal Kembali</th>
                                            <!-- <th scope="col">Kembali Status</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengembalian as $loopIndex => $pengembalians)
                                        <tr>
                                            <td>{{ $pengembalian->firstItem() + $loopIndex }}</td>
                                            <td>{{ $pengembalians->pengembalian_id ?? '-' }}</td>
                                            <td>{{ $pengembalians->peminjaman->peminjaman_id ?? '-' }}</td>
                                            <td>{{ $pengembalians->peminjaman->siswa->nama ?? '-' }}</td>
                                            <td>
                                                {{ $pengembalians->peminjaman->siswa->kelas->tingkat ?? '-' }}
                                                {{ $pengembalians->peminjaman->siswa->kelas->jurusan->nama_jurusan ?? '-' }}
                                                {{ $pengembalians->peminjaman->siswa->kelas->no_kosentrasi ?? '-' }}
                                            </td>
                                            <td>{{ $pengembalians->tanggal_kembali ?? '-' }}</td>
                                            <!-- <td>{{ $statusMapping[$pengembalians->kembali_status] ?? '-' }}</td> -->
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $pengembalian->links('livewire.bootstrap-pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>