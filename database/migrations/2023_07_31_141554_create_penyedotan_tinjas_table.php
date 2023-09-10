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
        Schema::create('penyedotan_tinja', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\KategoriPenyedotan::class,'id_kategori')->constrained('kategori_penyedotan');
            $table->string('nama');
            $table->string('nomor_karcis');
            $table->string('nomor_telpon');
            $table->text('alamat');
            $table->date('tanggal_penyedotan');
            $table->double('retribusi_penyedotan');
            $table->double('retribusi_pembuangan');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyedotan_tinja');
    }
};
