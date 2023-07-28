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
        Schema::create('sampah', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Kendaraan::class,'id_kendaraan')->constrained('kendaraan');
            $table->foreignIdFor(\App\Models\JenisSampah::class,'id_jenis_sampah')->constrained('jenis_sampah');
            $table->string('nomor_bak');
            $table->string('nomor_karcis');
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar');
            $table->enum('jenis_retribusi', ['umum', 'dinas']);
            $table->double('tarif_retribusi');
            $table->double('berat_masuk');
            $table->double('berat_keluar');
            $table->double('berat_sampah');
            $table->double('volume');
            $table->text('sumber_sampah');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sampah');
    }
};
