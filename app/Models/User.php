<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Menambahkan kelas Authenticatable
use Illuminate\Notifications\Notifiable; // Menambahkan Notifiable untuk notifikasi
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable // Mengubah kelas menjadi Authenticatable
{
    use HasApiTokens, HasFactory; 
    protected $table = 'tm_user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_nama',
        'user_pass',
        'user_hak',
        'user_sts',
    ];

    // Tentukan kolom yang disembunyikan (seperti password) saat dikembalikan dalam JSON
    protected $hidden = [
        'user_pass',  // Menyembunyikan password
    ];

    // Tentukan format timestamp
    public $timestamps = true;

    /**
     * Mutator untuk menyimpan password yang telah dienkripsi.
     *
     * @param string $password
     */
    // public function setUserPassAttribute($password)
    // {
    //     $this->attributes['user_pass'] = md5($password); // Menggunakan MD5 untuk menyimpan password
    // }

    /**
     * Fungsi untuk membuat token API (jika menggunakan Laravel Sanctum)
     */
    // public function createToken($name)
    // {
    //     return $this->createToken($name)->plainTextToken; // Memperbaiki pembuatan token
    // }
}
