<div>
    <div>
        <div>
            <div>
                <main id="main" class="main">
                    <div class="pagetitle">
                        <h1>Siswa</h1>
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
                                        <h5 class="card-title">Tambah Siswa</h5>

                                        <!-- General Form Elements -->
                                        <form wire:submit.prevent="store">
                                            <div class="row mb-3">
                                                <label for="kelas_id" class="col-sm-2 col-form-label">Kelas</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select" id="kelas_id" wire:model="kelas_id">
                                                        <option selected="">Pilih Kelas</option>
                                                        @foreach ($kelas as $kelass)
                                                        <option value="{{ $kelass->kelas_id }}">
                                                            {{ $kelass->tingkat }} {{ $kelass->jurusan->nama_jurusan ?? '' }} {{ $kelass->no_kosentrasi ?? '' }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('kelas_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="nama" class="col-sm-2 col-form-label">Nama Siswa</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nama" wire:model="nama">
                                                    @error('nama')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="nis" wire:model="nis">
                                                    @error('nis')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="email" wire:model="email">
                                                    @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12 text-end">
                                                <a wire:navigate href="/daftar-siswa" class="btn btn-outline-primary">Batal</a>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
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

        </div>
    </div>
</div>