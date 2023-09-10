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
        Schema::create('kegiatan_usaha', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->string('nama_penanggungjawab');
            $table->string('alamat');
            $table->string('dokumen_lh');
            $table->text('file_dokumen_lh');
            $table->foreignIdFor(\App\Models\SektorKegiatanUsaha::class,'id_sektor')->constrained('sektor_kegiatan_usaha');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_usaha');
    }
};
