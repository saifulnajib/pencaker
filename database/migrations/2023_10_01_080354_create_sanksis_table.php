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
        Schema::create('sanksi', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\KegiatanUsaha::class,'id_kegiatan_usaha')->constrained('kegiatan_usaha');
            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->text('alasan');
            $table->text('perintah');
            $table->boolean('status')->default(0);
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanksi');
    }
};
