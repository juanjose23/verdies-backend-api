<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductos;
use App\Http\Requests\UpdateProductos;
use App\Models\categorias;
use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = new Productos();
        $lista = $productos->ObtenerProductos();
        return response()->json([
            'estado' => 'exito',
            'productos' => $lista,
            'mensaje' => 'Lista de productos obtenida con exito.',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductos $request)
    {
        //
        $categoria = categorias::findOrFail($request->categorias_id);

        // Generar el código del producto
        $codigoProducto = Productos::generarCodigoProducto($categoria);
        $producto = new Productos();
        $producto->codigo = $codigoProducto;
        $producto->categorias_id = $request->categorias_id;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;

        $producto->save();

        return response()->json([
            'estado' => 'exito',
            'productos' => $producto,
            'mensaje' => 'producto creado con exito.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Productos $productos)
    {
        //
        $producto = new Productos();
        $lista = $producto->ObtenerProducto($productos->id);
        return response()->json([
            'estado' => 'exito',
            'producto' => $lista,
            'mensaje' => 'Producto obtenido con exito.',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductos $request, Productos $productos)
    {
        //
        $producto = Productos::findOrFail($productos->id);
        $producto->categorias_id=$request->categorias_id;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        return response()->json([
            'estado' => 'exito',
            'producto' => $producto,
            'mensaje' => 'producto actualizado con exito.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productos $productos)
    {
        //
         $producto = Productos::findOrFail($productos->id);
         $producto->estado = $producto->estado == 1 ? 0 : 1;
 
         $producto->save();
         return response()->json([
             'estado' => 'éxito',
             'mensaje' => 'producto eliminada con éxito.',
         ], 200);
    }
}
