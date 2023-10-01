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
        Schema::table('kegiatan_usaha', function (Blueprint $table) {
            $table->string('nomor_pertek')->nullable()->after('keterangan');
            $table->date('tanggal_pertek')->nullable()->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan_usaha', function (Blueprint $table) {
            $table->string('nomor_pertek')->nullable()->after('keterangan');
            $table->date('tanggal_pertek')->nullable()->after('keterangan');
        });
    }
};
