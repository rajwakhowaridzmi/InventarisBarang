<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asal extends Model
{
    use HasFactory;
    protected $table = 'asal';
    protected $primaryKey = 'asal_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'asal_id',
        'asal_barang',
    ];
    public function barangInventaris()
    {
        return $this->hasMany(BarangInventaris::class, 'asal_id', 'asal_id');
    }
}
