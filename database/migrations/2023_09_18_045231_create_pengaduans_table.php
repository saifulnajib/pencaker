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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_telpon');
            $table->string('lokasi_kejadian');
            $table->string('jenis_kegiatan');
            $table->string('nama_kegiatan');
            $table->dateTime('waktu_kejadian');
            $table->text('uraian_kejadian');
            $table->text('dampak');
            $table->text('penyelesaian');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
