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
        Schema::create('pemohon_pengalaman_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('jabatan');
            $table->string('uraian_tugas');
            $table->double('lama_bekerja');
            $table->year('tahun_mulai');
            $table->year('tahun_selesai');
            $table->string('nama_perusahaan');
            $table->text('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemohon_pengalaman_kerja');
    }
};
