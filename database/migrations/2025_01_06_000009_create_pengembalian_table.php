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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->string('pengembalian_id', 20)->primary();
            $table->string('peminjaman_id', 20)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->dateTime('kembali_tanggall')->nullable();
            $table->enum('kembali_status', ['0', '1'])->nullable();
            $table->timestamps();

            $table->foreign('peminjaman_id')->references('peminjaman_id')->on('peminjaman')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_pengembalian');
    }
};
