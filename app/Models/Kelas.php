<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $primaryKey = 'kelas_id';
    protected $table = 'kelas';
    protected $keyType = 'string';

    public $incrementing = false;
    protected $fillable = [
        'kelas_id',
        'jurusan_id',
        'tingkat',
        'no_kosentrasi',
    ];
    public function jurusan()
{
    return $this->belongsTo(Jurusan::class, 'jurusan_id', 'jurusan_id');
}

}
