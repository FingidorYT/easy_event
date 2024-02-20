<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alquiler;
use Illuminate\Support\Facades\Auth;

class AlquilerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Puedes implementar la lógica para mostrar una lista de todos los alquileres (para el área de administrador).
        $alquileres = Alquiler::all();
        return response()->json(['Alquileres' => $alquileres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar la solicitud y almacenar el nuevo alquiler.
        $validar = $request->validate([
            "user_id" => "required|numeric",
            "metodo_pago" => "required|string",
            "lugar_entrega" => "required|string",
            "fecha_alquiler" => "required|date",
            "fecha_devolucion" => "required|date"
        ]);

        // Crear el alquiler.
        $alquiler = Alquiler::create($request->all());

        // Puedes devolver una respuesta adecuada, por ejemplo, el ID del nuevo alquiler.
        return response()->json(['mensaje' => 'Alquiler creado exitosamente', 'id' => $alquiler->id], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        
    }

    public function contarAlquileres (Request $request)
    {

        // Mostrar alquileres según el estado y/o usuario (para el área de administrador).
        $estado = $request->estado;
        $user = Auth::user();
        $rol_id = $user->rol_id;
        

        if($rol_id==2){
                // Validar el estado para determinar qué alquileres mostrar.
            if ($estado === "a") {
                // Mostrar alquileres activos.
                $alquileres = AlquilerHasProducto::join('productos', 'alquiler_has_productos.producto_id', '=', 'productos.id')
                ->where('productos.empresa_id', 1)
                ->get();
                /*
                select count(*) from alquilers as al
INNER JOIN alquiler_has_productos as ap on al.id=ap.alquiler_id
INNER JOIN productos as pr on ap.producto_id=pr.id
inner JOIN empresas as em on pr.empresa_id=em.id
WHERE pr.empresa_id=1;*/
                
                    return response()->json(['Alquileres' => $alquileres], 200);

                //$alquileres = Alquiler::where('user_id', $user_id)->where('estado', "activo")->get();
            } else {
                // Mostrar todos los alquileres del usuario.
                //$alquileres = Alquiler::where('user_id', $user_id)->get();
        }

        }/*
        // Validar el estado para determinar qué alquileres mostrar.
        if ($estado === "a") {
            // Mostrar alquileres activos.
            $alquileres = Alquiler::where('user_id', $user_id)->where('estado', "activo")->get();
        } else {
            // Mostrar todos los alquileres del usuario.
            $alquileres = Alquiler::where('user_id', $user_id)->get();
        }*/

        // Devolver la respuesta.
        return response()->json(['Alquileres' => $user], 200);




    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Actualizar un alquiler existente (para el área de administrador).
        $user_id = $request->user_id;

        // Buscar alquileres pendientes del usuario.
        $alquiler = Alquiler::where('user_id', $user_id)->where('estado', "pendiente")->first();

        if ($alquiler) {
            // Validar la solicitud de actualización.
            $request->validate([
                "user_id" => "required|numeric",
                "metodo_pago" => "required|string",
                "lugar_entrega" => "required|string",
                "fecha_alquiler" => "required|date",
                "fecha_devolucion" => "required|date",
            ]);

            // Actualizar el alquiler.
            $alquiler->update($request->all());

            // Devolver la respuesta actualizada.
            return response()->json(['mensaje' => 'Alquiler actualizado exitosamente', 'alquiler' => $alquiler], 200);
        } else {
            // Indicar que no hay alquileres pendientes para el usuario.
            return response()->json(['mensaje' => 'No tiene alquileres pendientes'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Puedes implementar la lógica para eliminar un alquiler específico (para el área de administrador).
        $alquiler = Alquiler::find($id);

        if ($alquiler) {
            $alquiler->delete();
            return response()->json(['mensaje' => 'Alquiler eliminado exitosamente'], 200);
        } else {
            return response()->json(['mensaje' => 'Alquiler no encontrado'], 404);
        }
    }
}
