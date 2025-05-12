<?php

namespace Database\Seeders;

use App\Models\BahasaAsing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BahasaAsingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bahasaAsing = [
            ['name' => 'Indonesia'],
            ['name' => 'Inggris'],
            ['name' => 'Jepang'],
            ['name' => 'Mandarin'],
            ['name' => 'Tidak Ada'],
        ];

        foreach ($bahasaAsing as $item) {
            BahasaAsing::create($item);
        }
    }
}
