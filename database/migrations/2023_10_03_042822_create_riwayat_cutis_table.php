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
        Schema::create('riwayat_cuti', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Pegawai::class,'id_pegawai')->constrained('pegawai');
            $table->string('kategori_cuti');
            $table->string('alasan_cuti');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->double('lama');
            $table->double('sisa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_cuti');
    }
};
