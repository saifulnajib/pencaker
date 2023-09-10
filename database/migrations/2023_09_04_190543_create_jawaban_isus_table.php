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
        Schema::create('jawaban_isu', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\PenjaringanIsu::class,'id_penjaringan_isu')->constrained('penjaringan_isu');
            $table->string('opd');
            $table->string('token_opd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_isu');
    }
};
