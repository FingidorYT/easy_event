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
        $favorito = Favorito::all();
        return response()->json(['Favorito' => $favorito]);
    }

    public function store(Request $request)
    {
        //sirve para guardar datos en la bd
        //validacion de datos
        $this->validate($request, [

            'producto_id' => 'required',
            'user_id' => 'required',

        ]);

        $favorito = Favorito::add([
            'producto_id' => $request -> producto_id,
            'user_id' => $request -> user_id,

        ]);
        return response()->json(['Favorito' => $favorito], 201);
    }

    public function search(Request $request){
        $busqueda = $request->busqueda;

        $favorito = Favorito::where('producto_id', 'like', "%busqueda%")
                            ->orWhere('user_id', 'like', "%busqueda%")
                            ->get();

        return response()->json(['Producto' => $favorito]);
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
        // encontrar por id
        $favorito = Favorito::find($id);
        if(!$favorito){
            return response()->json(['error' => 'Favorito no encontrado', 404]);
        }
        //elimina el favorito
        $favorito->delete();

        return response()->json(['message' => 'Producto eliminado'], 200);
       
    }

}
