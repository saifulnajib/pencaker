<?php

namespace Database\Seeders;

use App\Models\Agama;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agama = [
            ['name' => 'Islam'],
            ['name' => 'Kristen'],
            ['name' => 'Katolik'],
            ['name' => 'Hindu'],
            ['name' => 'Budha'],
            ['name' => 'Konghucu'],
        ];

        foreach ($agama as $item) {
            Agama::create($item);
        }
    }
}
