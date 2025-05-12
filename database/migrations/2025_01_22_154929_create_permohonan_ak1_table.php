<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permohonan_ak1', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_agama')->constrained('agama');
            $table->foreignId('id_kelurahan')->constrained('kelurahans');
            $table->foreignId('id_besaran_upah')->constrained('master_besaran_upah');
            $table->foreignId('id_disabilitas')->nullable()->constrained('master_disabilitas');
            $table->foreignId('id_kelompok_jabatan')->constrained('master_kelompok_jabatan');
            $table->foreignId('id_sektor_usaha')->constrained('master_sektor_usaha');
            $table->foreignId('id_status_perkawinan')->constrained('master_status_perkawinan');
            $table->foreignId('id_tingkat_pendidikan')->constrained('master_tingkat_pendidikan');
            
            // Data Pribadi
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('nik')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->double('tinggi_badan')->nullable();
            $table->double('berat_badan')->nullable();
            $table->integer('jumlah_anak')->default(0);
            $table->enum('kendaraan', ['Tidak Punya', 'Roda 2', 'Roda 4']);
            $table->enum('gender', ['Perempuan', 'Laki-laki']);
            $table->enum('tempat_tinggal', ['Sewa', 'Milik Sendiri', 'Menumpang Dengan Keluarga']);
            $table->string('alamat');
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->string('kode_pos', 10);
            $table->string('no_hp', 15);
            
            // Pendidikan & Pekerjaan
            $table->string('institusi_pendidikan');
            $table->string('jurusan')->nullable();
            $table->year('tahun_lulus');
            $table->string('nilai');
            $table->string('jabatan_minat');
            $table->enum('lokasi_kerja', ['Dalam Negeri', 'Luar Negeri']);
            $table->string('kota_negara_minat');
            $table->text('keterangan_singkat_pengalaman')->nullable();
            $table->boolean('is_pernah_bekerja')->default(0);

            // Dokumen Pendukung
            $table->string('file_foto')->nullable();
            $table->string('file_ktp')->nullable();
            $table->string('file_ijazah')->nullable();
            $table->string('file_transkrip')->nullable();
            $table->string('file_ak1')->nullable();

            // Status
            $table->boolean('is_active')->default(0);
            $table->boolean('is_verified')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_ak1');
    }
};
