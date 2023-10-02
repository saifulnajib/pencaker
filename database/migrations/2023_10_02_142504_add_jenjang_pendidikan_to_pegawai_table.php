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
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('masa_kerja')->after('tmt')->nullable();
            $table->string('jenjang_pendidikan')->after('no_bpjs_tk')->nullable();
            $table->string('jurusan_pendidikan')->after('no_bpjs_tk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('masa_kerja')->after('tmt')->nullable();
            $table->string('jenjang_pendidikan')->after('no_bpjs_tk')->nullable();
            $table->string('jurusan_pendidikan')->after('no_bpjs_tk')->nullable();
        });
    }
};
