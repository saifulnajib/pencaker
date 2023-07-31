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
        Schema::table('surat_retribusi', function (Blueprint $table) {
            $table->string('nama_pemohon')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_retribusi', function (Blueprint $table) {
            $table->dropColumn('nama_pemohon');
        });
    }
};
