<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorias;
use App\Http\Requests\UpdateCategorias;
use App\Models\categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorias=categorias::All();
        return response()->json([
            'estado' => 'exito',
            'Categorias' => $categorias,
            'mensaje' => 'Lista de categorias obtenida con exito.',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorias $request)
    {
        //
        $categoria = new categorias();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->estado = $request->estado;
        
        $categoria->save();

        return response()->json([
            'estado' => 'exito',
            'verdcoins' =>$categoria,
            'mensaje' => 'Categoria creada con exito.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(categorias $categorias)
    {
        //
        $categoria =categorias::findOrFail($categorias->id);

        return response()->json([
            'estado' => 'éxito',
            'categoria' => $categoria,
            'mensaje' => 'Moneda obtenida con éxito.',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorias $request, categorias $categorias)
    {
        //
        $categoria = categorias::findOrFail($categorias->id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->estado = $request->estado;
        return response()->json([
            'estado' => 'exito',
            'categoria' => $categoria,
            'mensaje' => 'categoria actualizada con exito.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categorias $categorias)
    {
        //
        $categoria = categorias::findOrFail($categorias->id);
        $categoria->estado = $categoria->estado == 1 ? 0 : 1;

        $categoria->save();
        return response()->json([
            'estado' => 'éxito',
            'mensaje' => 'Categoria eliminada con éxito.',
        ], 200);
    }
}
