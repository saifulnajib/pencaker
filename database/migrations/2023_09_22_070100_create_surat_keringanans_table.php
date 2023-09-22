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
        Schema::create('surat_keringanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->string('jenis_bangunan');
            $table->string('nama_penanggungjawab');
            $table->string('nik');
            $table->string('nomor_telpon');
            $table->double('tarif_perda');
            $table->double('tarif_keringanan');
            $table->text('alasan');
            $table->text('alamat');
            $table->text('file_surat')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keringanan');
    }
};
