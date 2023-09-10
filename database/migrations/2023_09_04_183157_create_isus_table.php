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
        Schema::create('isu', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\DimensiIsu::class,'id_dimensi_isu')->constrained('dimensi_isu');
            $table->foreignIdFor(\App\Models\PenjaringanIsu::class,'id_penjaringan_isu')->constrained('penjaringan_isu');
            $table->string('isu');
            $table->text('justifikasi_pencemaran')->nullable();
            $table->text('justifikasi_urgensi')->nullable();
            $table->text('kaitan_isu_rpjmd')->nullable();
            $table->text('kaitan_isu_klhs')->nullable();
            $table->text('kaitan_isu_tpb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isu');
    }
};
