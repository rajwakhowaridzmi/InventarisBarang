<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Daftar Peminjaman</h1>
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
                            <h5 class="card-title">Tambah Barang</h5>

                            <!-- General Form Elements -->
                            <form wire:submit.prevent="store">
                                <div class="row mb-3">
                                    <label for="peminjaman_id" class="col-sm-2 col-form-label">Id Transaksi</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="peminjaman_id" wire:model="peminjaman_id">
                                            <option selected="">Pilih ID Transaksi</option>
                                            @foreach ($peminjaman as $peminjamans)
                                            <option value="{{ $peminjamans->peminjaman_id }}">{{ $peminjamans->peminjaman_id }}</option>
                                            @endforeach
                                        </select>

                                        @error('peminjaman_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="barang_kode" class="col-sm-2 col-form-label">Pilih Barang Kode</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="barang_kode" wire:model="barang_kode" multiple aria-label="multiple select example">
                                            @foreach ($barang as $barangs)
                                            <option value="{{ $barangs->barang_kode }}">{{ $barangs->barang_kode }} | {{ $barangs->nama_barang}}</option>
                                            @endforeach
                                        </select>

                                        @error('barang_kode')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="status_pmj" class="col-sm-2 col-form-label">Status Kembali</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="status_pmj" wire:model="status_pmj">
                                            <option selected="">Tentukan Kondisi</option>
                                            <option value="0">Barang Sudah dikembalikan</option>
                                            <option value="1">Barang Sedang Dipinjam</option>
                                        </select>
                                        @error('status_pmj')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tanggal_entry" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal_entry" wire:model="tanggal_entry">
                                    </div>
                                </div>



                                <div class="col-sm-12 text-end">
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                    <a wire:navigate href="/daftar-pengembalian-barang" class="btn btn-outline-primary">Batal</a>
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