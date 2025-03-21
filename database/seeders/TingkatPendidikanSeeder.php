<?php

namespace Database\Seeders;

use App\Models\TingkatPendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TingkatPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tingkat_pendidikan = [
            ['name' => 'Sekolah Dasar'],
            ['name' => 'Sekolah Menengah Pertama'],
            ['name' => 'Sekolah Menengah Atas'],
            ['name' => 'Sekolah Menengah Kejuruan'],
            ['name' => 'Diploma 1'],
            ['name' => 'Diploma 2'],
            ['name' => 'Diploma 3'],
            ['name' => 'Sarjana'],
            ['name' => 'Magister'],
            ['name' => 'Doktoral'],
        ];

        foreach ($tingkat_pendidikan as $item) {
            TingkatPendidikan::create($item);
        }
    }
}
