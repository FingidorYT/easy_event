<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $producto = Producto::all();
        return response()->json(['Producto' => $producto]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion de datos
        $this->validate($request, [
            'codigo' => 'required',
            'precio' => 'required',
            'nombre_producto' => 'required',
            'cantidad_disponible' => 'required',
            'cantidad_inventario' => 'required',
            'categoria_id' => 'required',
            'empresa_id' => 'required',

        ]);

        // Crear un nuevo producto
        $producto = Producto::create([
            'codigo' => $request->codigo,
            'precio' => $request->precio,
            'nombre_producto' => $request->nombre_producto,
            'cantidad_disponible' => $request->cantidad_disponible,
            'cantidad_inventario' => $request->cantidad_inventario,
            'categoria_id' => $request->categoria_id,
            'empresa_id' => $request->empresa_id,
        ]);

        return response()->json(['Producto' => $producto], 201);
    }

    public function search(Request $request){
        $busqueda = $request->busqueda;
        $filtro = $request->categoria;
        $categoria = Categoria::find($filtro);

        if ($categoria) {
            $producto = Producto::where('codigo', 'like', "%$busqueda%")
                            ->orWhere('nombre_producto', 'like',"%$busqueda%")
                            ->where('categoria_id', $categoria->id)
                            ->get();

        return response()->json(['Producto' => $producto]);
        }
        //return response()->json(['Producto' => $busqueda]);

        $producto = Producto::where('codigo', 'like', "%$busqueda%")
                            ->orWhere('nombre_producto', 'like',"%$busqueda%")
                            ->get();
        

        return response()->json(['Producto' => $producto]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto= Producto::find($id);
        return response()->json($producto,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validamos datos
        $this->validate($request, [
            'codigo' => 'required',
            'precio' => 'required',
            'nombre_producto' => 'required',
            'cantidad_disponible' => 'required',
            'cantidad_inventario' => 'required',
            'categoria_id' => 'required',
            'empresa_id' => 'required',
        ]);
        // buscar el producto por id o no se si por codigo
        $producto = Producto::find($id);

        // un if x si no se encuentra
        if(!$producto){
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        //nuevos datos
        $producto->update([
        'codigo' => $request->codigo,
        'precio' => $request->precio,
        'nombre_producto' => $request->nombre_producto,
        'cantidad_disponible' => $request->cantidad_disponible,
        'cantidad_inventario' => $request->cantidad_inventario,
        'categoria_id' => $request->categoria_id,
        'empresa_id' => $request->empresa_id,
        ]);
        return response()->json(['message' => 'Producto actualizado', 'Producto'=>$producto]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //encontrar por id
        $producto = Producto::find($id);

        if(!$producto){
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        // eliminamos el producto
        $producto->delete();

        return response()->json(['message'=>'Producto eliminado'], 200);
    }
}
