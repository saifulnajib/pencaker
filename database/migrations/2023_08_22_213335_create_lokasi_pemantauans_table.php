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
        Schema::create('lokasi_pemantauan', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\KegiatanUsaha::class,'id_kegiatan_usaha')->constrained('kegiatan_usaha');
            $table->date('tanggal_pemantauan');
            $table->double('latitude');
            $table->double('longitude');
            $table->boolean('is_kualitas_udara')->default(1);
            $table->boolean('is_kualitas_air_limbah')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_pemantauan');
    }
};
