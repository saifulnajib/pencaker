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
        Schema::create('pengelolaan_limbah', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\KegiatanUsaha::class,'id_kegiatan_usaha')->constrained('kegiatan_usaha');
            $table->string('jenis_limbah');
            $table->string('kode_limbah');
            $table->string('perizinan')->nullable();
            $table->string('nomor')->nullable();
            $table->string('tahun')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengelolaan_limbah');
    }
};
