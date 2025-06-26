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
        Schema::create('pemohon_pendidikan', function (Blueprint $table) {
            $table->string('nik',16);
            $table->foreignId('id_tingkat_pendidikan')->constrained('master_tingkat_pendidikan');
            $table->string('institusi_pendidikan');
            $table->string('jurusan')->nullable();
            $table->year('tahun_lulus');
            $table->string('nilai');
            $table->string('file_ijazah')->nullable();
            $table->string('file_transkrip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemohon_pendidikan');
    }
};
