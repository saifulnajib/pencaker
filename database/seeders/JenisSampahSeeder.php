<?php

namespace Database\Seeders;

use App\Models\JenisSampah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        JenisSampah::truncate();
        JenisSampah::create([ 'jenis' => 'Sampah Umum', 'is_active' => 1 ]);
        JenisSampah::create([ 'jenis' => 'Sampah Permukiman', 'is_active' => 1 ]);
        Schema::enableForeignKeyConstraints();
    }
}
