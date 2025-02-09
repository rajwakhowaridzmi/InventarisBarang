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
                            <h5 class="card-title">Edit Barang</h5>

                            <!-- General Form Elements -->
                            <form wire:submit.prevent="update">
                            <div class="row mb-3">
                                    <label for="barang_kode" class="col-sm-2 col-form-label">Kode Barang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="barang_kode" wire:model="barang_kode" readonly>
                                        @error('barang_kode')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_barang" wire:model="nama_barang">
                                        @error('nama_barang')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="jns_brg_kode" class="col-sm-2 col-form-label">Jenis Barang</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="jns_brg_kode" wire:model="jns_brg_kode">
                                            <option selected="">Pilih Jenis</option>
                                            @foreach ($jenis_barang as $jenis_barangs )
                                            <option value="{{ $jenis_barangs->jns_brg_kode}}">
                                                {{ $jenis_barangs->jns_brg_nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('jns_brg_kode')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tanggal_terima" class="col-sm-2 col-form-label">Tanggal Terima</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal_terima" wire:model="tanggal_terima">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tanggal_entry" class="col-sm-2 col-form-label">Tanggal Entry</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal_entry" wire:model="tanggal_entry" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="kondisi_barang" class="col-sm-2 col-form-label">Kondisi Barang</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="kondisi_barang" wire:model="kondisi_barang">
                                            <option selected="">Tentukan Kondisi</option>
                                            <option value="1">Kondisi Baik</option>
                                            <option value="2">Kondisi rusak, bisa diperbaiki</option>
                                            <option value="3">Kondisi rusak, tidak bisa digunakan</option>
                                        </select>
                                        @error('kondisi_barang')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="status_barang" class="col-sm-2 col-form-label">Status Barang</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="status_barang" wire:model="status_barang">
                                            <option selected="">Status</option>
                                            <option value="0">Dipinjam</option>
                                            <option value="1">Dikembalikan</option>
                                        </select>
                                        @error('status_barang')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="asal_id" class="col-sm-2 col-form-label">Status Barang</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="asal_id" wire:model="asal_id">
                                        <option selected="">Pilih Asal</option>
                                            @foreach ($asal as $asals )
                                            <option value="{{ $asals->asal_id}}">
                                                {{ $asals->asal_barang }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('asal_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12 text-end">
                                    <button type="submit" class="btn btn-primary">Edit Barang</button>
                                    <a wire:navigate href="/daftar-barang" class="btn btn-outline-primary">Batal</a>
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