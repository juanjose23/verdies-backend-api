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

        $Monedas = [
            [
                'nombre' => 'Verdcoins',
                'descripcion' => 'Moneda virtual estándar para realizar transacciones y compras en la plataforma.',
                'estado' => 1
            ],
            [
                'nombre' => 'Verdcoins Premium',
                'descripcion' => 'Moneda virtual premium que ofrece beneficios adicionales y descuentos exclusivos en la plataforma.',
                'estado' => 1
            ]
        ];


        foreach ($Monedas as $moneda) {
            VerdCoins::create($moneda);
          
        }

    }
}
