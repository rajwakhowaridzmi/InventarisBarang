<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'peminjaman_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'peminjaman_id',
        'siswa_id',
        'user_id',
        'tanggal_pinjam',
        'harus_kembali_tgl',
        'peminjaman_status'
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function barang_inventaris()
    {
        return $this->hasMany(BarangInventaris::class, 'barang_kode', 'barang_kode');
    }
}
