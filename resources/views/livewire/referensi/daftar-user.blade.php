<div>
    @php
    $statuMapping = [
    0 => 'Super User', 
    1 => 'Administrator',
    2 => 'Operator'
    ];
    @endphp
<div>
    <div>
        <div>
            <main id="main" class="main">
                <div class="pagetitle">
                    <h1>Daftar Pengguna</h1>
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
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Daftar Pengguna</h5>
                                        <!-- <button class="btn btn-primary" wire:navigate href="/tambah-jenis-barang">Tambah Jenis</button> -->
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">role</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $users)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $users->user_nama ?? '-'}}</td>
                                                <td>{{ $statuMapping[$users->role] ?? '-'}}</td>
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
</div>
