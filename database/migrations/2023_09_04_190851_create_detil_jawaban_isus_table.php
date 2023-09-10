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
        Schema::create('detil_jawaban_isu', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\JawabanIsu::class,'id_jawaban_isu')->constrained('jawaban_isu');
            $table->foreignIdFor(\App\Models\Isu::class,'id_isu')->constrained('isu');
            $table->integer('skala_pencemaran')->default(1);
            $table->integer('skala_urgensi')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detil_jawaban_isu');
    }
};
