<?php

namespace Database\Seeders;

use App\Models\categorias;
use App\Models\Productos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $productos = [
            [
                'categorias_id' => 1, // Plásticos
                'nombre' => 'Botella PET',
                'descripcion' => 'Botella de plástico reciclable de tipo PET.',
                'estado' => 1
            ],
            [
                'categorias_id' => 2, // Papel y Cartón
                'nombre' => 'Caja de Cartón',
                'descripcion' => 'Caja de cartón reciclado.',
                'estado' => 1
            ],
            [
                'categorias_id' => 3, // Vidrio
                'nombre' => 'Botella de Vidrio',
                'descripcion' => 'Botella de vidrio transparente.',
                'estado' => 1
            ],
            [
                'categorias_id' => 4, // Metales
                'nombre' => 'Lata de Aluminio',
                'descripcion' => 'Lata de aluminio reciclable.',
                'estado' => 1
            ],
            // Puedes añadir más productos siguiendo la misma estructura
        ];
        foreach ($productos as $producto) {
            $categoria = categorias::find($producto['categorias_id']);
            $producto['codigo'] = Productos::generarCodigoProducto($categoria);

            DB::table('productos')->insert($producto);
        }
    }
}
