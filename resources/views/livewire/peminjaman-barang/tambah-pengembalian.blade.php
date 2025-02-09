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
                            <h5 class="card-title">Pengembalian Barang</h5>

                            <!-- General Form Elements -->
                            <form wire:submit.prevent="store">
                                <div class="row mb-3">
                                    <label for="peminjaman_id" class="col-sm-2 col-form-label">Nama Peminjam</label>
                                    <div class="col-sm-10">
                                        <div class="dropdown">
                                            <!-- Input Pencarian -->
                                            <div class="input-group">
                                                <input type="text"
                                                    wire:model.live="searchSiswa"
                                                    class="form-control"
                                                    placeholder="Cari Nama Siswa..."
                                                    @if($peminjaman_id) readonly @endif>

                                                <!-- Tombol Reset -->
                                                @if($peminjaman_id)
                                                <button class="btn btn-primary" type="button" wire:click="resetPeminjaman">X</button>
                                                @endif
                                            </div>

                                            <!-- Dropdown Hasil Pencarian -->
                                            @if(!empty($filteredPeminjaman) && !empty($searchSiswa) && !$peminjaman_id)
                                            <div class="dropdown-menu w-100 show" style="max-height: 200px; overflow-y: auto;">
                                                @foreach ($filteredPeminjaman as $peminjaman)
                                                <a class="dropdown-item" href="#"
                                                    wire:click.prevent="selectPeminjaman('{{ $peminjaman->peminjaman_id }}', '{{ $peminjaman->siswa->nama }}', '{{ $peminjaman->siswa->kelas->tingkat }} {{ $peminjaman->siswa->kelas->jurusan->nama_jurusan }} {{ $peminjaman->siswa->kelas->no_kosentrasi }}')">
                                                    {{ $peminjaman->peminjaman_id }} | {{ $peminjaman->siswa->nama }} -
                                                    {{ $peminjaman->siswa->kelas->tingkat }} {{ $peminjaman->siswa->kelas->jurusan->nama_jurusan }} {{ $peminjaman->siswa->kelas->no_kosentrasi }}
                                                </a>
                                                @endforeach
                                            </div>
                                            @endif

                                            <input type="hidden" wire:model="peminjaman_id">
                                        </div>

                                        @error('peminjaman_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="user_nama" class="col-sm-2 col-form-label">Penginput</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_nama" value="{{ $user_nama }}" readonly>
                                        <input type="hidden" wire:model="user_id">

                                    </div>
                                </div>

                                <!-- <div class="row mb-3">
                                    <label for="tanggal_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal_kembali" wire:model="tanggal_kembali">
                                    </div>
                                </div> -->

                                <div class="col-sm-12 text-end">
                                    <a wire:navigate href="/daftar-pengembalian" class="btn btn-outline-primary">Batal</a>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">
                                        Tambahkan
                                    </button>

                                </div>
                            </form><!-- End General Form Elements -->

                            @if (session()->has('message'))
                            <div class="alert alert-success mt-3">
                                {{ session('message') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- Modal Konfirmasi -->
                    <div wire:ignore.self class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" style="margin-top: 150px" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="konfirmasiModalLabel">Periksa Kelengkapan Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group">
                                        @foreach ($barang_details as $barang)
                                        <li class="list-group-item">
                                            {{ $barang->barang_kode }} | {{ $barang->nama_barang }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Belum</button>
                                    <button type="button" class="btn btn-primary" wire:click="konfirmasiPengembalian">Sudah</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
</div>