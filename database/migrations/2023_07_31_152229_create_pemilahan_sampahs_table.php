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
        Schema::create('pemilahan_sampah', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Kendaraan::class,'id_kendaraan')->constrained('kendaraan');
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar');
            $table->double('berat_masuk');
            $table->double('berat_keluar');
            $table->double('berat_sampah');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemilahan_sampah');
    }
};
