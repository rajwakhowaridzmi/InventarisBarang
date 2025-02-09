<div>
    <div>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Jurusan</h1>
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
                                <h5 class="card-title">Tambah Jurusan</h5>

                                <!-- General Form Elements -->
                                <form wire:submit.prevent="store">
                                    <div class="row mb-3">
                                        <label for="nama_jurusan" class="col-sm-2 col-form-label">Jenis Jurusan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama_jurusan" wire:model="nama_jurusan">
                                            @error('nama_jurusan')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 text-end">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                        <a wire:navigate href="/jurusan" class="btn btn-outline-primary">Batal</a>
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