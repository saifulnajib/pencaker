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
        Schema::create('penjaringan_isu', function (Blueprint $table) {
            $table->id();
            $table->text('file_banner')->nullable();
            $table->timestamp('started_at');
            $table->timestamp('closed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjaringan_isu');
    }
};
