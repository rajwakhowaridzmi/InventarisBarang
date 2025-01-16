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
        Schema::create('peminjaman_barang', function (Blueprint $table) {
            $table->string('pjm_barang_id', 20)->primary();
            $table->string('peminjaman_id', 20)->nullable();
            $table->string('barang_kode', 12)->nullable();
            // $table->dateTime('pdb_tgl')->nullable();
            $table->string('status_pmj', 2)->nullable();    
            $table->timestamps();

            $table->foreign('peminjaman_id')->references('peminjaman_id')->on('peminjaman')->onDelete('cascade');
            $table->foreign('barang_kode')->references('barang_kode')->on('barang_inventaris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('td_peminjaman_barang');
    }
};
