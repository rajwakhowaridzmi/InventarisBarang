<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->string('peminjaman_id', 20)->primary();
            $table->string('siswa_id', 20)->nullable();
            $table->string('user_id', 10)->nullable();
            $table->date('tanggal_pinjam')->nullable();
            $table->dateTime('harus_kembali_tgl')->nullable();
            $table->timestamps();
            
            $table->foreign('siswa_id')->references('siswa_id')->on('siswa')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
            // $table->string('pb_nama_siswa', 100)->nullable();
            // $table->dateTime('pb_harus_kembali_tgl')->nullable();
            // $table->string('pb_stat', 2)->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_peminjaman');
    }
};
