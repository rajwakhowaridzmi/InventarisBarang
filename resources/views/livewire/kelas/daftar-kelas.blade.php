<div>
    <div>
        <div>
            <main id="main" class="main">
                <div class="pagetitle">
                    <h1>Daftar Kelas</h1>
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
                                        <h5 class="card-title">Kelas</h5>
                                        <button class="btn btn-primary" wire:navigate href="/tambah-kelas">Tambah Kelas</button>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Jurusan</th>
                                                <th scope="col">Tingkat</th>
                                                <th scope="col">No Kosentrasi</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kelas as $kelass)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $kelass->jurusan->nama_jurusan ?? '-'}}</td>
                                                <td>{{ $kelass->tingkat ?? '-'}}</td>
                                                <td>{{ $kelass->no_kosentrasi ?? '-'}}</td>
                                                <td>
                                                    <a wire:navigate href="/edit-kelas/{{ $kelass->kelas_id}}" class="bi bi-pencil-square fs-3"></a>
                                                    <a wire:click="delete({{ $kelass->kelas_id }})" href="#" class="bi bi-trash fs-3" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"></a>
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
</div>