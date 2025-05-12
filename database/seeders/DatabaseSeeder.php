<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AgamaSeeder::class,
            StatusPerkawinanSeeder::class,
            TingkatPendidikanSeeder::class,
            KelompokJabatanSeeder::class,
            BahasaAsingSeeder::class,
            DisabilitasSeeder::class,
            BesaranUpahSeeder::class,
            SektorUsahaSeeder::class,
            KecamatanSeeder::class,
            KelurahanSeeder::class,
            PermohonanAK1Seeder::class,
        ]);
    }
}
