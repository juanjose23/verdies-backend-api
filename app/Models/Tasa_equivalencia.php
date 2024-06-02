<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasa_equivalencia extends Model
{
    use HasFactory;
    protected $table = 'tasa_equivalencia';

    protected $fillable = [
        'productos_id',
        'verdcoins_id',
        'cantidad',
        'estado'
    ];
    public function productos()
    {
        return $this->belongsTo('App\Models\Productos');
    }
    public function verdcoins()
    {
        return $this->belongsTo('App\Models\VerdCoins');
    }

    /**
     *Devuelve todo los historicos de la equivalencia del producto.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function ObtenerTasa($id)
    {
        // Buscar la tasa de equivalencia con sus relaciones
        $tasaEquivalencia = self::where('productos_id', $id)->get();

        // Cargar las relaciones necesarias
        $tasaEquivalencia->load(['productos', 'productos.categorias', 'verdcoins']);

        $ListaTasas = $tasaEquivalencia->map(function ($tasa) {
            return [
                'categoria' => $tasa->productos->categorias->nombre ?? 'No disponible',
                'producto' => $tasa->productos->nombre ?? 'No disponible',
                'moneda' => $tasa->verdcoins->nombre ?? 'No disponible',
                'cantidad' => $tasa->cantidad,
                'estado' => $tasa->estado,
            ];
        });
        return $ListaTasas;
    }


    /**
     * Obtiene las tasas de equivalencia con información de categoría del producto , producto, moneda y cantidad.
     *
     * @return \Illuminate\Support\Collection
     */
    public function ObtenerListaTasas()
    {
        $tasaEquivalencias = self::with(['productos', 'productos.categorias', 'verdcoins'])->get();

        $ListaTasas = $tasaEquivalencias->map(function ($tasa) {
            return [
                'categoria' => $tasa->productos->categorias->nombre,
                'producto' => $tasa->productos->nombre,
                'moneda' => $tasa->VerdCoins->nombre,
                'cantidad' => $tasa->cantidad,
                'estado' => $tasa->estado,
            ];
        });

        return $ListaTasas;
    }



}
