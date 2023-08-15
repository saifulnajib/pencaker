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
        Schema::create('proklim', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignIdFor(\App\Models\KategoriProklim::class,'id_kategori')->constrained('kategori_proklim');
            $table->text('no_registrasi');
            $table->string('alamat');
            $table->string('kode_wilayah');
            $table->int('tahun_proklim');
            $table->text('file_sertifikat');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proklim');
    }
};
