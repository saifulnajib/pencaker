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
        Schema::create('permohonan_ak1', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Agama::class,'id_agama')->constrained('agama');
            $table->foreignIdFor(\App\Models\Kelurahan::class,'id_kelurahan')->constrained('kelurahans');
            $table->foreignIdFor(\App\Models\BesaranUpah::class,'id_besaran_upah')->constrained('master_besaran_upah');
            $table->foreignIdFor(\App\Models\Disabilitas::class,'id_disabilitas')->constrained('master_disabilitas');
            $table->foreignIdFor(\App\Models\KelompokJabatan::class,'id_kelompok_jabatan')->constrained('master_kelompok_jabatan');
            $table->foreignIdFor(\App\Models\SektorUsaha::class,'id_sektor_usaha')->constrained('master_sektor_usaha');
            $table->foreignIdFor(\App\Models\SektorUsaha::class,'id_status_perkawinan')->constrained('master_sektor_perkawinan');
            $table->foreignIdFor(\App\Models\SektorUsaha::class,'id_tingkat_pendidikan')->constrained('master_tingkat_pendidikan');
            $table->string('nama');
            $table->string('email');
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->double('tinggi_badan');
            $table->double('berat_badan');
            $table->double('jumlah_anak')->default(0);
            $table->enum('kendaraan', ['Tidak Punya', 'Roda 2','Roda 4']);
            $table->enum('gender', ['Perempuan','Laki-laki']);
            $table->enum('tempat_tinggal', ['Sewa','Milik Sendiri','Menumpang Dengan Keluarga']);
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('kode_pos');
            $table->string('no_hp');
            $table->string('institusi_pendidikan');
            $table->string('jurusan')->nullable();
            $table->string('tahun_lulus');
            $table->string('nilai');
            $table->string('jabatan_minat');
            $table->enum('lokasi_kerja', ['Dalam Negeri','Luar Negeri']);
            $table->string('kota_negara_minat');
            $table->text('keterangan_singkat_pengalaman')->nullable();
            $table->text('file_foto')->nullable();
            $table->text('file_ktp')->nullable();
            $table->text('file_ijazah')->nullable();
            $table->text('file_transkrip')->nullable();
            $table->text('file_ak1')->nullable();
            $table->boolean('is_pernah_bekerja')->default(0);
            $table->boolean('is_active')->default(0);
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
