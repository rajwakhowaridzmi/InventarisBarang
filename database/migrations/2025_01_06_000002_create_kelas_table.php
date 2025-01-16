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
        Schema::create('kelas', function (Blueprint $table) {
            $table->bigIncrements('kelas_id')->primary();
            $table->unsignedBigInteger('jurusan_id');
            $table->enum('tingkat', ['10', '11', '12']);
            $table->string('no_kosentrasi', 2);
            $table->timestamps();

            $table->foreign('jurusan_id')->references('jurusan_id')->on('jurusan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
