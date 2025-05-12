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
        Schema::create('lokers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Perusahaan::class, 'id_perusahaan')
                  ->nullable()
                  ->constrained('perusahaan')
                  ->nullOnDelete();
            $table->string('posisi');
            $table->text('deskripsi');
            $table->text('kualifikasi');
            $table->string('lokasi');
            $table->string('gaji');
            $table->string('gambar');
            $table->dateTime('expired');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokers');
    }
};