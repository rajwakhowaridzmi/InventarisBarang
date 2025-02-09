<div>
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
                            <h5 class="card-title">Edit Peminjaman</h5>

                            <form wire:submit.prevent="update">
                                <div class="row mb-3">
                                    <label for="peminjaman_id" class="col-sm-2 col-form-label">Jenis Jurusan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="peminjaman_id" wire:model="peminjaman_id" readonly>
                                        @error('peminjaman_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="siswa_id" class="col-sm-2 col-form-label">Nama Peminjam</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="siswa_id" wire:model="siswa_id">
                                            <option selected="">Pilih Peminjam</option>
                                            @foreach ($siswa as $siswas)
                                            <option value="{{ $siswas->siswa_id }}">
                                                {{ $siswas->nama }}
                                                {{ $siswas->kelas->tingkat }}
                                                {{ $siswas->kelas->jurusan->nama_jurusan }}
                                                {{ $siswas->kelas->no_kosentrasi }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('siswa_id')
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

                                <div class="row mb-3">
                                    <label for="tanggal_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal_pinjam" wire:model="tanggal_pinjam">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="harus_kembali_tgl" class="col-sm-2 col-form-label">Batas Peminjaman</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="harus_kembali_tgl" wire:model="harus_kembali_tgl">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="peminjaman_status" class="col-sm-2 col-form-label">Status Peminjaman</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="peminjaman_status" wire:model="peminjaman_status">
                                            <option selected="">Tentukan Kondisi</option>
                                            <option value="0">Dihapus Sistem</option>
                                            <option value="1">Peminjaman Aktif</option>
                                        </select>
                                        @error('peminjaman_status')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-sm-12 text-end">
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                    <a wire:navigate href="/daftar-peminjaman" class="btn btn-outline-primary">Batal</a>
                                </div>
                            </form><!-- End General Form Elements -->

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