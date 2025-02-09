<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_barang';
    protected $primaryKey = 'pjm_barang_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pjm_barang_id',
        'peminjaman_id',
        'barang_kode',
        'status_pmj',
        'tanggal_entry'
    ];
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id', 'peminjaman_id');
    }
    public function barangInventaris()
    {
        return $this->belongsTo(BarangInventaris::class, 'barang_kode', 'barang_kode');
    }
}
