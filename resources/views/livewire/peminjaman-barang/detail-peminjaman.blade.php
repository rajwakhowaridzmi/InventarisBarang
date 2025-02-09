<div>
    @php
    $statusMapping = [
    '0' => 'Dihapus Sistem',
    '1' => 'Peminjaman Aktif'
    ];
    $peminjaman_status = (string) $peminjaman_status;
    @endphp
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Penerimaan Barang</h1>
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
                            <h5 class="card-title">Detail Peminjaman</h5>

                            <!-- Detail Peminjaman -->
                            <div class="row mb-3">
                                <label for="peminjaman_id" class="col-sm-2 col-form-label">Jenis Jurusan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="peminjaman_id" value="{{ $peminjaman_id }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="siswa_id" class="col-sm-2 col-form-label">Nama Peminjam</label>
                                <div class="col-sm-10">
                                    <div class="form-control" readonly>
                                        @foreach ($siswa as $siswas)
                                        @if ($siswas->siswa_id == $siswa_id)
                                        {{ $siswas->nama }}
                                        {{ $siswas->kelas->tingkat }}
                                        {{ $siswas->kelas->jurusan->nama_jurusan }}
                                        {{ $siswas->kelas->no_kosentrasi }}
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="barang_kode" class="col-sm-2 col-form-label">Barang</label>
                                <div class="col-sm-10">
                                    <ol class="list-group list-group">
                                        @foreach($barang_list as $barang)
                                        <li class="list-group-item">{{ $barang->barang_kode }} | {{ $barang->nama_barang }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="user_nama" class="col-sm-2 col-form-label">Penginput</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="user_nama" value="{{ $user_nama }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tanggal_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tanggal_pinjam" value="{{ $tanggal_pinjam }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="harus_kembali_tgl" class="col-sm-2 col-form-label">Batas Peminjaman</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="harus_kembali_tgl" value="{{ $harus_kembali_tgl }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="peminjaman_status" class="col-sm-2 col-form-label">Status Peminjaman</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="peminjaman_status" value="{{ $statusMapping[$peminjaman_status] ?? 'Status Tidak Ditemukan' }}" readonly>
                                </div>
                            </div>


                            <div class="col-sm-12 text-end">
                                <a href="/daftar-peminjaman" class="btn btn-primary">Kembali</a>
                            </div>

                            @if (session()->has('message'))
                            <div class="alert alert-success mt-3">
                                {{ session('message') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>