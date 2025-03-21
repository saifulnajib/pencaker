<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('password')],
        ];

        foreach ($user as $item) {
            User::create($item);
        }
    }
}
