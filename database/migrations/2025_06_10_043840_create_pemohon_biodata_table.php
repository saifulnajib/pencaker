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
        Schema::create('pemohon_biodata', function (Blueprint $table) {
            $table->string('nik',16);
            $table->foreignId('id_agama')->constrained('agama');
            $table->foreignId('id_kelurahan')->constrained('kelurahans');
            $table->foreignId('id_disabilitas')->nullable()->constrained('master_disabilitas');
            $table->integer('id_status_perkawinan');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->double('tinggi_badan')->nullable();
            $table->double('berat_badan')->nullable();
            $table->double('jumlah_anak')->default(0);
            $table->enum('kendaraan', ['Tidak Punya', 'Roda 2', 'Roda 4']);
            $table->enum('gender', ['Perempuan', 'Laki-laki']);
            $table->enum('tempat_tinggal', ['Sewa', 'Milik Sendiri', 'Menumpang Dengan Keluarga']);
            $table->string('alamat');
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->string('kode_pos', 10);
            $table->string('no_hp', 15);
            $table->string('file_foto')->nullable();
            $table->string('file_ktp')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemohon_biodata');
    }
};
