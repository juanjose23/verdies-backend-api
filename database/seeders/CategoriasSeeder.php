<?php

namespace Database\Seeders;

use App\Models\categorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categorias = [
            [
                'nombre' => 'Plásticos',
                'descripcion' => 'Botellas de plástico, envases de alimentos y bebidas, bolsas de plástico, plásticos de alta densidad (HDPE)',
                'estado' => 1
            ],
            [
                'nombre' => 'Papel y Cartón',
                'descripcion' => 'Periódicos, revistas, cajas de cartón, papel de oficina',
                'estado' => 1
            ],
            [
                'nombre' => 'Vidrio',
                'descripcion' => 'Botellas de vidrio, frascos de vidrio',
                'estado' => 1
            ],
            [
                'nombre' => 'Metales',
                'descripcion' => 'Latas de aluminio, latas de acero, chatarra metálica',
                'estado' => 1
            ],
            [
                'nombre' => 'Tetra Pak',
                'descripcion' => 'Envases de cartón para bebidas (leche, jugos)',
                'estado' => 1
            ],
            [
                'nombre' => 'Orgánicos',
                'descripcion' => 'Residuos de alimentos, desechos de jardín',
                'estado' => 1
            ],
            [
                'nombre' => 'Electrónicos',
                'descripcion' => 'Aparatos electrónicos pequeños, baterías, teléfonos móviles',
                'estado' => 1
            ],
            [
                'nombre' => 'Textiles',
                'descripcion' => 'Ropa, zapatos, telas',
                'estado' => 1
            ],
            [
                'nombre' => 'Aceite usado',
                'descripcion' => 'Aceite de cocina usado',
                'estado' => 1
            ],
            [
                'nombre' => 'Residuos peligrosos',
                'descripcion' => 'Pilas y baterías, productos químicos domésticos, pinturas y solventes',
                'estado' => 1
            ]
        ];


        foreach ($categorias as $categoria) {
            categorias::create($categoria);
          
        }

    }
}
