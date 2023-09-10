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
        Schema::table('lokasi_pemantauan', function (Blueprint $table) {
            $table->text('parameter_ika')->nullable();
            $table->text('parameter_iku')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lokasi_pemantauan', function (Blueprint $table) {
            $table->text('parameter_ika')->nullable();
            $table->text('parameter_iku')->nullable();
        });
    }
};
