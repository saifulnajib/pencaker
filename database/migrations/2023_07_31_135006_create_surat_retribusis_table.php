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
        Schema::create('surat_retribusi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->string('jenis_usaha');
            $table->text('alamat_usaha');
            $table->string('nomor_telpon');
            $table->double('tarif_retribusi');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_retribusi');
    }
};
