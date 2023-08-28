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
        Schema::create('pengawasan', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\KegiatanUsaha::class,'id_kegiatan_usaha')->constrained('kegiatan_usaha');
            $table->date('tanggal_pengawasan');
            $table->text('temuan_pengawasan');
            $table->string('surat_tindaklanjut');
            $table->text('rekomendasi_hasil_pengawasan');
            $table->date('batas_waktu_tindaklanjut');
            $table->text('tindaklanjut_usaha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengawasan');
    }
};
