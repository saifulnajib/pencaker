<?php

namespace Database\Seeders;

use App\Models\Kelurahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelurahan = [
            ['name' => 'Kelurahan 1', 'id_kecamatan' => 1],
            ['name' => 'Kelurahan 2', 'id_kecamatan' => 2],
            ['name' => 'Kelurahan 3', 'id_kecamatan' => 3],
        ];

        foreach ($kelurahan as $item) {
            Kelurahan::create($item);
        }
    }
}
