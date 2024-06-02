<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMonedas;
use App\Http\Requests\UpdateVerdCoins;
use App\Models\VerdCoins;
use Illuminate\Http\Request;

class VerdCoinsController extends Controller
{
    //
    public function index()
    {
        $monedas = VerdCoins::GetVerdCoins();

        return response()->json([
            'estado' => 'exito',
            'verdcoins' => $monedas,
            'mensaje' => 'Lista de monedas obtenida con exito.',
        ], 200);
    }

    public function store(StoreMonedas $request)
    { 
        $moneda = new VerdCoins();
        $moneda->nombre = $request->nombre;
        $moneda->descripcion = $request->descripcion;
        $moneda->estado = $request->estado;

        $moneda->save();

        return response()->json([
            'estado' => 'exito',
            'verdcoins' => $moneda,
            'mensaje' => 'Moneda creada con exito.',
        ], 201);

    }

    public function update(UpdateVerdCoins $request, VerdCoins $verdcoins)
    {
       

        $moneda = VerdCoins::findOrFail($verdcoins->id);
        $moneda->nombre = $request->nombre;
        $moneda->descripcion = $request->descripcion;
        $moneda->estado = $request->estado;
        return response()->json([
            'estado' => 'exito',
            'verdcoins' => $moneda,
            'mensaje' => 'Moneda actualizada con exito.',
        ], 200);
    }



    public function show(VerdCoins $verdcoins)
    {
        $moneda = VerdCoins::findOrFail($verdcoins->id);

        return response()->json([
            'estado' => 'éxito',
            'verdcoins' => $moneda,
            'mensaje' => 'Moneda obtenida con éxito.',
        ], 200);
    }



    public function destroy(VerdCoins $verdcoins)
    {
        $moneda = VerdCoins::findOrFail($verdcoins->id);
        $moneda->estado = $moneda->estado == 1 ? 0 : 1;

        $moneda->save();
        return response()->json([
            'estado' => 'éxito',
            'mensaje' => 'Moneda eliminada con éxito.',
        ], 200);
    }
}
