<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangInventaris extends Model
{
    use HasFactory;
    protected $table = 'barang_inventaris';
    protected $primaryKey = 'barang_kode';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'barang_kode',
        'jns_brg_kode',
        'user_id',
        'nama_barang',
        'tanggal_terima',
        'tanggal_entry',
        'kondisi_barang',
        'status_barang',
        'asal_id',
    ];

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jns_brg_kode');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function asal()
    {
        return $this->belongsTo(Asal::class, 'asal_id');
    }
}
