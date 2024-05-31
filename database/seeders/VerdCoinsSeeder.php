<?php

namespace Database\Seeders;

use App\Models\VerdCoins;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VerdCoinsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        VerdCoins::create([
            'nombre' =>'VerdCoins',
            'descripcion' => 'Moneda de canje' 
        ]);

    }
}
