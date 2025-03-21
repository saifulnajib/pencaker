<?php

namespace Database\Seeders;

use App\Models\BesaranUpah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BesaranUpahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $besaran_upah = [
            ['min' => 1000000, 'max' => 1500000],
            ['min' => 1500000, 'max' => 2000000],
            ['min' => 2000000, 'max' => 2500000],
        ];

        foreach ($besaran_upah as $item) {
            BesaranUpah::create($item);
        }
    }
}
