<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatan = [
            ['name' => 'Kecamatan 1'],
            ['name' => 'Kecamatan 2'],
            ['name' => 'Kecamatan 3'],
        ];

        foreach ($kecamatan as $item) {
            Kecamatan::create($item);
        }
    }
}
