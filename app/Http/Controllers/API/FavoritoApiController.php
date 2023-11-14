<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorito;

class FavoritoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //pagina de inicio
    }

    public function store(Request $request)
    {
        //sirve para guardar datos en la bd
    }

    public function agregarFavorito(Request $request)
    {
        // obtener el usuario autenticado
        $usuario = auth::user();

        // verficar si el producto ya está en fav
        $favoritoExis = Favorito::where('user_id',$usuario->id)
                                ->where('producto_id', $request)
                                ->first();
        if ($favoritoExis) {
            return response()->json(['mensaje' => 'El producto ya está en favoritos']);
        }

// agg fav
    $favorito = new Favorito();
    $favorito->user_id = $usuario->id;
    $favorito->producto_id = $request;
    $favorito->save();

    return response()->json(['mensaje' => 'Producto agregado a favoritos']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //registro de la tabla
    }

    // EL EDIT sirve para traer los 
    // datos que se van a editar y colocarlos en un formulario
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //actualiza datos en la bd
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //elimina un registro
       
    }
    public function eliminarFavorito($request)
    {
     // obtener el usuario auten
     $usuario = auth::user();

     // buscar y eliminar producto de fav
     Favorito::where('user_id', $usuario->id)
             ->where('productos_id', $request)
             ->delete();

     return response()->json(['mensaje' => 'Producto eliminado de favoritos']);
    }

}
