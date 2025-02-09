<div>
<div>
    <div>
        <div>
            <main id="main" class="main">
                <div class="pagetitle">
                    <h1>Kelas</h1>
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
                                    <h5 class="card-title">Tambah Kelas</h5>

                                    <!-- General Form Elements -->
                                    <form wire:submit.prevent="update">
                                        <div class="row mb-3">
                                            <label for="jurusan_id" class="col-sm-2 col-form-label">Jurusan</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" id="jurusan_id" wire:model="jurusan_id">
                                                    <option selected="">Pilih Jurusan</option>
                                                    @foreach ($jurusans as $jurusan)
                                                    <option value="{{ $jurusan->jurusan_id }}">{{ $jurusan->nama_jurusan }}</option>
                                                    @endforeach
                                                </select>
                                                @error('jurusan_id')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="tingkat" class="col-sm-2 col-form-label">Tingkat</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" id="tingkat" wire:model="tingkat">
                                                    <option selected="">Pilih Tingkat</option>
                                                    <option value="X">X</option>
                                                    <option value="XI">XI</option>
                                                    <option value="XII">XII</option>
                                                </select>
                                                @error('tingkat')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="no_kosentrasi" class="col-sm-2 col-form-label">No Konsentrasi</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" id="no_kosentrasi" wire:model="no_kosentrasi">
                                                    <option selected="">No Konsentrasi</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                @error('no_kosentrasi')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 text-end">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                            <a wire:navigate href="/daftar-kelas" class="btn btn-outline-primary">Batal</a>
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
