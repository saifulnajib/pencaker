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
        Schema::create('pengolahan_kompos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Kendaraan::class,'id_kendaraan')->constrained('kendaraan');
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar');
            $table->double('berat_masuk')->default(0);
            $table->double('berat_keluar')->default(0);
            $table->double('berat_isi')->default(0);
            $table->double('kompos_keluar')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengolahan_kompos');
    }
};
