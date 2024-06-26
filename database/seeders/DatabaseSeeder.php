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
        $this->call(VerdCoinsSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(ProductosSeeder::class);
        $this->call(UserSeeder::class);
    }
}
