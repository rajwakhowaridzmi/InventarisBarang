<div>
    <div>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Daftar Jurusan</h1>
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
                                    <h5 class="card-title">Jurusan</h5>
                                    <button class="btn btn-primary" wire:navigate href="/tambah-jurusan">Tambah Jurusan</button>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Jurusan</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jurusan as $jurusans)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $jurusans->nama_jurusan ?? '-'}}</td>
                                            <td>
                                                <a wire:navigate href="/edit-jurusan/{{ $jurusans->jurusan_id}}" class="bi bi-pencil-square fs-3"></a>
                                                <a wire:click="delete({{ $jurusans->jurusan_id }})" href="#" class="bi bi-trash fs-3" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"></a>
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

</div>