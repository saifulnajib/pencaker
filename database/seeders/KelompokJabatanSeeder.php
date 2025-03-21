<?php

namespace Database\Seeders;

use App\Models\KelompokJabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelompokJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelompok_jabatan = [
            ['name' => 'Kepala Dinas'],
            ['name' => 'Kepala Bidang'],
            ['name' => 'Kepala Seksi'],
        ];

        foreach ($kelompok_jabatan as $item) {
            KelompokJabatan::create($item);
        }
    }
}
