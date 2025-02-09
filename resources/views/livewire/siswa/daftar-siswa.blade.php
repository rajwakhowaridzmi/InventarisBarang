<div>
    @php
    $statusMapping = [
    0 => 'Tidak Aktif',
    1 => 'Aktif',
    ];
    @endphp
    <div>
        <div>
            <main id="main" class="main">
                <div class="pagetitle">
                    <h1>Daftar Siswa</h1>
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
                                        <h5 class="card-title">Siswa</h5>
                                        <button class="btn btn-primary" wire:navigate href="/tambah-siswa">Tambah Siswa</button>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Nis</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswa as $siswas)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $siswas->nama ?? '-'}}</td>
                                                <td>{{ $siswas->kelas->tingkat }} {{ $siswas->kelas->jurusan->nama_jurusan ?? '' }} {{ $siswas->kelas->no_kosentrasi ?? '' }}</td>
                                                <td>{{ $siswas->nis ?? '-'}}</td>
                                                <td>{{ $siswas->email ?? '-'}}</td>
                                                <td class=" {{ $siswas->siswa_status == '0' ? 'text-danger' : 'text-success' }}">{{ $statusMapping[$siswas->siswa_status] ?? '-'}}</td>
                                                <td>
                                                    <a wire:navigate href="/edit-siswa/{{ $siswas->siswa_id}}" class="bi bi-pencil-square fs-3"></a>
                                                    
                                                    <a href="#"class="bi bi-trash fs-3"onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini?')) { delete({{ $siswas->siswa_id }}) }"></a>
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