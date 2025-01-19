<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'siswa_id';
    public $incrementing = false;
    protected $fillable = [
        'kelas_id',
        'nama',
        'nis',
        'email',
        'siswa_status',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }


    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
    public function peminjaman()
{
    return $this->hasMany(Peminjaman::class, 'siswa_id');
}

    
}
