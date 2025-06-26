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
        Schema::create('pemohon_pekerjaan', function (Blueprint $table) {
            $table->string('nik',16);
            $table->foreignId('id_besaran_upah')->constrained('master_besaran_upah');
            $table->foreignId('id_kelompok_jabatan')->constrained('master_kelompok_jabatan');
            $table->foreignId('id_sektor_usaha')->constrained('master_sektor_usaha');
            $table->string('jabatan_minat');
            $table->enum('lokasi_kerja', ['Dalam Negeri', 'Luar Negeri']);
            $table->string('kota_negara_minat');
            $table->boolean('is_pernah_bekerja')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemohon_pekerjaan');
    }
};
