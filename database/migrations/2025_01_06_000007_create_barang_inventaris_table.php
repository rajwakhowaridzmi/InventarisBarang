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
        Schema::create('barang_inventaris', function (Blueprint $table) {
            $table->string('barang_kode', 12)->primary();
            $table->string('jns_brg_kode', 10)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_barang', 50)->nullable();
            $table->date('tanggal_terima')->nullable();
            $table->dateTime('tanggal_entry')->nullable();
            $table->enum('kondisi_barang', ['0', '1'])->nullable();
            $table->enum('status_barang',['0', '1'])->nullable(); 
            $table->unsignedBigInteger('asal_id')->nullable();
            $table->timestamps();
             
            $table->foreign('jns_brg_kode')->references('jns_brg_kode')->on('jenis_barang')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
            $table->foreign('asal_id')->references('asal_id')->on('asal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_barang_inventaris');
    }
};
