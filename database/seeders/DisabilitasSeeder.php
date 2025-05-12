<?php

namespace Database\Seeders;

use App\Models\Disabilitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisabilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $disabilitas = [
            ['name' => 'Tuna Rungu'],
            ['name' => 'Tuna Netra'],
            ['name' => 'Tuna Daksa'],
        ];

        foreach ($disabilitas as $item) {
            Disabilitas::create($item);
        }
    }
}
