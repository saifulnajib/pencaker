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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_sk')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->date('tanggal_awal_kerja')->nullable();
            $table->enum('jenis_pegawai', ['PNS','PTT','THL']);
            $table->enum('jenis_kelamin', ['L','P']);
            $table->string('golongan')->nullable();
            $table->string('ruang')->nullable();
            $table->string('tmt')->nullable();
            $table->string('nama_jabatan')->nullable();
            $table->string('bidang')->nullable();
            $table->string('tmt_jabatan')->nullable();
            $table->string('nama_latihan')->nullable();
            $table->string('bulan_tahun_latihan')->nullable();
            $table->string('lama_latihan')->nullable();
            $table->string('nama_pendidikan')->nullable();
            $table->string('lulusan_pendidikan')->nullable();
            $table->string('tingkat_ijazah_pendidikan')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat')->nullable();
            $table->string('nomor_telpon')->nullable();
            $table->string('no_bpjs')->nullable();
            $table->string('no_bpjs_tk')->nullable();
            $table->string('no_pbb')->nullable();
            $table->string('status_nikah')->nullable();
            $table->string('gol_darah')->nullable();
            $table->string('agama')->nullable();
            $table->string('sertifikat_kompetensi')->nullable();
            $table->string('tugas_jabatan')->nullable();
            $table->string('lokasi_kerja_pengawas')->nullable();
            $table->string('lokasi_kerja_pekerja')->nullable();
            $table->string('nama_korlap')->nullable();
            $table->string('nama_pengawas')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('status_keaktifan')->nullable();
            $table->date('tanggal_status_keaktifan')->nullable();
            $table->text('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
