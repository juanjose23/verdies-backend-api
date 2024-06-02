<?php

namespace App\Http\Controllers;

use App\Models\Tasa_equivalencia;
use Illuminate\Http\Request;

class TasaEquivalenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasaEquivalencias = new Tasa_equivalencia();
        $lista = $tasaEquivalencias->ObtenerListaTasas();
        return response()->json([
            'estado' => 'exito',
            'Tasas' => $lista,
            'mensaje' => 'Lista de tasas obtenida con exito.',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $tasaEquivalencia = Tasa_equivalencia::create([
            'productos_id' => $request->productos_id,
            'verdcoins_id' => $request->verdcoins_id,
            'cantidad' => $request->cantidad,
            'estado' => 1
        ]);

        return response()->json([
            'estado' => 'exito',
            'verdcoins' =>$tasaEquivalencia,
            'mensaje' => 'Tasa creada con exito.',
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Tasa_equivalencia $tasa_equivalencia)
    {
        //
         $tasaEquivalencias = new Tasa_equivalencia();
        $lista = $tasaEquivalencias->ObtenerTasa($tasa_equivalencia->id);
        return response()->json([
            'estado' => 'exito',
            'Tasa' => $lista,
            'mensaje' => 'Tasa obtenida con exito.',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasa_equivalencia $tasa_equivalencia)
    {
        //
        $tasaEquivalencias = Tasa_equivalencia::findOrFail($tasa_equivalencia->id);
        $tasaEquivalencias->update(['estado' => 0]);

        // Create a new record
        $newTasaEquivalencia = Tasa_equivalencia::create([
            'productos_id' => $request->productos_id,
            'verdcoins_id' => $request->verdcoins_id,
            'cantidad' => $request->cantidad,
            'estado' => 1
        ]);

        return response()->json([
            'estado' => 'exito',
            'Tasa' => $newTasaEquivalencia,
            'mensaje' => 'Tasa actualizada con exito.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasa_equivalencia $tasa_equivalencia)
    {
        //
        $tasaEquivalencias = Tasa_equivalencia::findOrFail($tasa_equivalencia->id);
        $tasaEquivalencias->estado = $tasaEquivalencias->estado == 1 ? 0 : 1;

        $tasaEquivalencias->save();
        return response()->json([
            'estado' => 'exito',
            'mensaje' => 'Tasa eliminada con éxito.',
        ], 200);

    
    }
}
