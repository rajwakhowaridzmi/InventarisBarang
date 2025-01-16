<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
     
    protected $primaryKey = 'jurusan_id';

    protected $table = 'jurusan';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'jurusan_id',
        'nama_jurusan',
    ];
    public function kelas()
{
    return $this->hasMany(Kelas::class, 'jurusan_id', 'jurusan_id');
}

}
