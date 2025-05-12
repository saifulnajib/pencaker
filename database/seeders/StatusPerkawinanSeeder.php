<?php

namespace Database\Seeders;

use App\Models\StatusPerkawinan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPerkawinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status_perkawinan = [
            ['name' => 'Belum Kawin'],
            ['name' => 'Kawin'],
            ['name' => 'Janda/duda'],
            ['name' => 'Cerai Hidup'],
            ['name' => 'Cerai Mati'],
        ];

        foreach ($status_perkawinan as $item) {
            StatusPerkawinan::create($item);
        }
    }
}
