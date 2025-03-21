<?php

namespace Database\Seeders;

use App\Models\SektorUsaha;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SektorUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sektor_usaha = [
            ['name' => 'Pertanian'],
            ['name' => 'Peternakan'],
            ['name' => 'Kehutanan'],
            ['name' => 'Perikanan'],
            ['name' => 'Industri Pengolahan'],
            ['name' => 'Listrik, Gas, dan Air Bersih'],
            ['name' => 'Konstruksi'],
            ['name' => 'Perdagangan, Hotel, dan Restoran'],
            ['name' => 'Transportasi dan Komunikasi'],
        ];
        
        foreach ($sektor_usaha as $item) {
            SektorUsaha::create($item);
        }
    }
}
