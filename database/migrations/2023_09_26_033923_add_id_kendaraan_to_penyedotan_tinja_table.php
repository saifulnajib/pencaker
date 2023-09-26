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
        Schema::table('penyedotan_tinja', function (Blueprint $table) {
            $table->bigInteger('id_kendaraan')->after('id_kategori');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyedotan_tinja', function (Blueprint $table) {
            $table->bigInteger('id_kendaraan')->after('id_kategori');
        });
    }
};
