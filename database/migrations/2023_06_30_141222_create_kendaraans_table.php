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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nopol');
            $table->string('sopir');
            $table->unsignedBigInteger('jenis_kendaraan');
            $table->unsignedBigInteger('rute');
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('jenis_kendaraan')->references('id')->on('jenis_kendaraan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rute')->references('id')->on('rute')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
