<?php

use App\Livewire\BarangInventaris\TambahBarang;
use App\Livewire\Kelas\DaftarKelas;
use App\Livewire\PeminjamanBarang\TambahPeminjamanBarang;
use App\Livewire\PeminjamanBarang\TambahPengembalianBarang;
use App\Livewire\Siswa\TambahJurusan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangInventarisController;
use App\Http\Controllers\LoginController;
use App\Livewire\Login;
use App\Livewire\BarangInventaris\DaftarBarang;
use App\Livewire\BarangInventaris\EditBarang;
use App\Livewire\Dashboard;
use App\Livewire\Kelas\EditKelas;
use App\Livewire\Kelas\TambahKelas;
use App\Livewire\Laporan\LaporanDaftarBarang;
use App\Livewire\Laporan\LaporanPengembalianBarang;
use App\Livewire\Laporan\LaporanStatusBarang;
use App\Livewire\PeminjamanBarang\DaftarPeminjaman;
use App\Livewire\PeminjamanBarang\DaftarPengembalian;
use App\Livewire\PeminjamanBarang\EditPeminjaman;
use App\Livewire\PeminjamanBarang\EditPengembalian;
use App\Livewire\PeminjamanBarang\TambahPeminjaman;
use App\Livewire\PeminjamanBarang\TambahPengembalian;
use App\Livewire\PeminjamanBarang\DaftarPengembalianBarang;
use App\Livewire\PeminjamanBarang\DetailPeminjaman;
use App\Livewire\Referensi\DaftarJenisBarang;
use App\Livewire\Referensi\DaftarUser;
use App\Livewire\Referensi\EditJenisBarang;
use App\Livewire\Referensi\TambahJenisBarang;
use App\Livewire\Siswa\DaftarSiswa;
use App\Livewire\Siswa\EditJurusan;
use App\Livewire\Siswa\EditSiswa;
use App\Livewire\Siswa\Jurusan;
use App\Livewire\Siswa\TambahSiswa;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', Login::class)->middleware('guest')->name('login');
Route::post('/logout', [Login::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/jurusan', Jurusan::class)->name('jurusan');
    Route::get('/tambah-jurusan', TambahJurusan::class)->name('tambah-jurusan');
    Route::get('/edit-jurusan/{jurusan_id}', EditJurusan::class)->name('edit-jurusan');
    Route::get('/daftar-kelas', DaftarKelas::class)->name('daftar-kelas');
    Route::get('/tambah-kelas', TambahKelas::class)->name('tambah-kelas');
    Route::get('/edit-kelas/{kelas_id}', EditKelas::class)->name('edit-kelas');
    Route::get('/daftar-siswa', DaftarSiswa::class)->name('daftar-siswa');
    Route::get('/tambah-siswa', TambahSiswa::class)->name('tambah-siswa');
    Route::get('/edit-siswa/{siswa_id}', EditSiswa::class)->name('edit-siswa');
    Route::get('/daftar-jenis-barang', DaftarJenisBarang::class)->name('daftar-jenis-barang');
    Route::get('/tambah-jenis-barang', TambahJenisBarang::class)->name('tambah-jenis-barang');
    Route::get('/edit-jenis-barang/{jns_brg_kode}', EditJenisBarang::class)->name('edit-jenis-barang');
    Route::get('/daftar-pengguna', DaftarUser::class)->name('daftar-user');
    Route::get('/daftar-barang', DaftarBarang::class)->name('daftar-barang');
    Route::get('/tambah-barang', TambahBarang::class)->name('tambah-barang');
    Route::get('/edit-barang/{barang_kode}', EditBarang::class)->name('edit-barang');
    Route::get('/daftar-peminjaman', DaftarPeminjaman::class)->name('daftar-peminjaman');
    Route::get('/tambah-peminjaman', TambahPeminjaman ::class)->name('tambah-peminjaman');
    Route::get('/edit-peminjaman/{peminjaman_id}', EditPeminjaman::class)->name('edit-peminjaman');
    Route::get('/detail-peminjaman/{peminjaman_id}', DetailPeminjaman::class)->name('detail-peminjaman');
    Route::get('/daftar-pengembalian', DaftarPengembalian::class)->name('daftar-pengembalian');
    Route::get('/tambah-pengembalian', TambahPengembalian::class)->name('tambah-pengembalian');
    Route::get('/edit-pengembalian/{pengembalian_id}', EditPengembalian::class)->name('edit-pengembalian');
    Route::get('/daftar-pengembalian-barang', DaftarPengembalianBarang::class)->name('daftar-pengembalian-barang');
    Route::get('/tambah-pengembalian-barang', TambahPengembalianBarang::class)->name('tambah-pengembalian-barang');
    Route::get('/tambah-peminjaman-barang', TambahPeminjamanBarang::class)->name('tambah-peminjaman-barang');
    Route::get('/laporan-daftar-barang', LaporanDaftarBarang::class)->name('laporan.daftar.barang');
    Route::get('/laporan-pengembalian-barang', LaporanPengembalianBarang::class)->name('laporan.pengembalian.barang');
    Route::get('/laporan-status-barang', LaporanStatusBarang::class)->name('laporan.status.barang');
});

