<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alquiler;

class AlquilerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validar = $request->validate([
            "user_id" => "required|numeric",
            "metodo_pago" => "required|string",
            "lugar_entrega" => "required|string",
            "fecha_alquiler" => "required|date",
            "fecha_devolucion" => "required|date"
        ]);
        Alquiler::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $estado = $request->estado;
        $user_id = $request->user_id;
        if ($estado === "a" ){
        $alquiler = Alquiler::where('user_id', $user_id)->where('estado', "activo")->get();
        if ($alquiler) {
            return response()->json($alquiler, 200);
        }else {
            echo "--".$alquiler."No tiene alquileres Activos";
        }
        }else {
            $alquiler = Alquiler::where('user_id', $user_id)->get();
            if ($alquiler) {
                return response()->json($alquiler, 200);
            }else {
                echo "No tiene alquileres";
            }
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
