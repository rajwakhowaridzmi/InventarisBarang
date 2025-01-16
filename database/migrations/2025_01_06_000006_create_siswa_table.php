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
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('siswa_id')->primary();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('nis', 20)->nullable();
            $table->string('email')->nullable();
            $table->enum('siswa_status', ['0', '1'])->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')->references('kelas_id')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
