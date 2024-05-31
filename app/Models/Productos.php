<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Productos extends Model
{
    use HasFactory;

    public function categorias()
    {
        return $this->belongsTo('App\Models\categorias');
    }


    /**
     * Obtiene el producto con información de categoría, código, nombre, descripción y estado.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function ObtenerProducto($id)
    {
        // Obtener el producto con sus relaciones de categoría
        $producto = self::with(['categorias'])->findOrFail($id);

      

        // Transformar el producto para incluir solo la información deseada
        $productoTransformado = [
            'categoria' => $producto->categorias->nombre,
            'codigo' => $producto->codigo,
            'nombre' => $producto->nombre,
            'descripcion' => $producto->descripcion,
            'estado' => $producto->estado,
        ];

        // Devolver el producto transformado como un array
        return $productoTransformado;
    }


    /**
     * Obtiene los productos con información de categoría, código, nombre, descripción y estado.
     *
     * @return \Illuminate\Support\Collection
     */
    public function ObtenerProductos()
    {
        // Obtener todos los productos con sus relaciones de categoría
        $productos = self::with('categorias')->get();

        $productosTransformados = $productos->map(function ($producto) {
            return [
                'categoria' => $producto->categorias->nombre,
                'codigo' => $producto->codigo,
                'nombre' => $producto->nombre,
                'descripcion' => $producto->descripcion,
                'estado' => $producto->estado,
            ];
        });

        return $productosTransformados;
    }



    /**
     * Genera el código de un producto basado en la categoría.
     *
     * @param  \App\Models\categorias  $categoria
     * @return string
     */
    public static function generarCodigoProducto(categorias $categoria)
    {
        // Obtener el prefijo del nombre de la categoría y convertirlo a slug
        $prefijo = Str::slug($categoria->nombre, '-');

        $ultimoProducto = self::where('categorias_id', $categoria->id)->orderBy('id', 'desc')->first();
        $siguienteId = $ultimoProducto ? $ultimoProducto->id + 1 : 1;

        // Generar el código del producto concatenando el prefijo y el ID
        return $prefijo . '-' . str_pad($siguienteId, 5, '0', STR_PAD_LEFT);
    }

}
