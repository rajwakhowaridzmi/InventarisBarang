<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';
    protected $primaryKey = 'pengembalian_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'pengembalian_id',
        'peminjaman_id',
        'user_id',
        'tanggal_kembali',
        'kembali_status',
    ];
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
