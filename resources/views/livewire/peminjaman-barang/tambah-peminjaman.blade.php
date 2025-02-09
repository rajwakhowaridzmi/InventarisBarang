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
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Barang</h5>

                            <!-- General Form Elements -->
                            <form wire:submit.prevent="store">
                                <div class="row mb-3">
                                    <label for="siswa_id" class="col-sm-2 col-form-label">Nama Peminjam</label>
                                    <div class="col-sm-10">
                                        <div class="dropdown">
                                            <div class="input-group">
                                                <input type="text"
                                                    wire:model.live="searchSiswa"
                                                    class="form-control"
                                                    placeholder="Cari Nama Siswa..."
                                                    @if($siswa_id) readonly @endif>
                                                @if($siswa_id)
                                                <button class="btn btn-primary" type="button" wire:click="resetSiswa">X</button>
                                                @endif
                                            </div>
                                            @if(!empty($filteredSiswa) && !empty($searchSiswa) && !$siswa_id)
                                            <div class="dropdown-menu w-100 show" style="max-height: 200px; overflow-y: auto;">
                                                @foreach ($filteredSiswa as $siswas)
                                                <a class="dropdown-item" href="#" wire:click.prevent="selectSiswa('{{ $siswas->siswa_id }}', '{{ $siswas->nama }}')">
                                                    {{ $siswas->nama }} | {{ $siswas->kelas->tingkat }} {{ $siswas->kelas->jurusan->nama_jurusan }} {{ $siswas->kelas->no_kosentrasi }}
                                                </a>
                                                @endforeach
                                            </div>
                                            @endif
                                            <input type="hidden" wire:model="siswa_id">
                                        </div>
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
                                    <label for="barang_kode" class="col-sm-2 col-form-label">Barang</label>
                                    <div class="col-sm-10">
                                        @if (!empty($barang_kode))
                                        <ul class="list-group">
                                            @foreach ($barang_kode as $kode)
                                            @php
                                            $barangItem = collect($barang)->firstWhere('barang_kode', $kode);
                                            @endphp
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $barangItem->barang_kode }} | {{ $barangItem->nama_barang }}
                                                <a wire:click="kurangBarang('{{ $barangItem->barang_kode }}')" class="btn btn-primary btn-sm">
                                                    Hapus
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <div class="border p-2 rounded text-muted">
                                            Belum ada barang yang dipilih
                                        </div>
                                        @endif
                                        @error('barang_kode')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="harus_kembali_tgl" class="col-sm-2 col-form-label">Batas Peminjaman</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="harus_kembali_tgl" wire:model="harus_kembali_tgl">
                                    </div>
                                </div>

                                <div class="col-sm-12 text-end">
                                    <a wire:navigate href="/daftar-peminjaman" class="btn btn-outline-primary">Batal</a>
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                </div>
                            </form>
                            @if (session()->has('message'))
                            <div class="alert alert-success mt-3">
                                {{ session('message') }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Barang yang Bisa Dipinjam</h5>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari Barang..." wire:model.live="searchQuery">
                            </div>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode Barang</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="barang-table-body">
                                    @foreach ($barang as $index => $barangs)
                                    @php
                                    $isSelected = in_array($barangs->barang_kode, $barang_kode);
                                    @endphp
                                    <tr data-barang-name="{{ strtolower($barangs->nama_barang) }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $barangs->barang_kode }}</td>
                                        <td>{{ $barangs->nama_barang }}</td>
                                        <td>
                                            <a href="#"
                                                class="bi bi-plus-circle-fill fs-3 {{ $isSelected ? 'text-muted disabled' : 'text-primary' }}"
                                                wire:click.prevent="tambahBarang('{{ $barangs->barang_kode }}')">
                                            </a>
                                            <a href="#"
                                                class="bi bi-dash-circle-fill fs-3 {{ $isSelected ? 'text-primary' : 'text-muted disabled' }}"
                                                wire:click.prevent="kurangBarang('{{ $barangs->barang_kode }}')">
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
</div>