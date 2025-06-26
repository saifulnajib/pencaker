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
        Schema::create('pengalaman_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_permohonan')->constrained('permohonan_ak1');
            $table->string('jabatan');
            $table->string('uraian_tugas');
            $table->double('lama_bekerja');
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
        Schema::dropIfExists('pengalaman_kerja');
    }
};
