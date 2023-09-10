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
        Schema::create('zonasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_zona');
            $table->double('luas')->default(0);
            $table->text('keterangan')->nullable();
            $table->double('keterisian')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zonasi');
    }
};
