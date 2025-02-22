<div>
    <div>
        <div>
            <main id="main" class="main">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="pagetitle">
                        <h1>Daftar Kelas</h1>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item">Pages</li>
                                <li class="breadcrumb-item active">Blank</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Alert Success -->
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show ms-3" role="alert" style="min-width: 300px;">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
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
                                                    <a wire:click="confirmDelete({{ $kelass->kelas_id }})" class="bi bi-trash fs-3 cursor-pointer" data-bs-toggle="modal" data-bs-target="#konfirmasiHapusModal"></a>
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
            <div wire:ignore.self class="modal fade" id="konfirmasiHapusModal" tabindex="-1" aria-labelledby="konfirmasiHapusModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" style="margin-top: 150px">
                    <div class="modal-content">
                        <div class="modal-header flex-column align-items-center">
                            <h5 class="modal-title text-center" id="konfirmasiHapusModalLabel">Konfirmasi Hapus</h5>
                            <div style="width: 50%; height: 4px; background-color: var(--bs-primary); margin: 5px auto -2px auto; border-radius: 8px;"></div>
                        </div>
                        <div class="modal-body d-flex flex-column align-items-center justify-content-center text-center mt-3">
                            <p>Apakah Anda yakin ingin menghapus kelas ini?</p>
                        </div>

                        <div class="modal-footer d-flex justify-content-center gap-1">
                            <button type="button" class="btn btn-outline-primary flex-fill" data-bs-dismiss="modal">Tidak</button>
                            <button type="button" class="btn btn-primary flex-fill" wire:click="delete({{ $kelas_id }})">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('closeModal', () => {
            var modalElement = document.getElementById('konfirmasiHapusModal');
            var modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            }
        });
    });
</script>