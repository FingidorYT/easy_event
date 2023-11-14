<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::all();
        return response()->json(['data' => $empresas], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nit_empresa' => 'required|numeric',
            'direccion_empresa' => 'required|string',
            'nombre_empresa' => 'required|string',
            'telefono_empresa' => 'required|numeric',
            'email_empresa' => 'required|email',
        ]);

        $empresa = Empresa::create($request->all());
        return response()->json(['data' => $empresa], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        return response()->json(['data' => $empresa], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nit_empresa' => 'numeric',
            'direccion_empresa' => 'string',
            'nombre_empresa' => 'string',
            'telefono_empresa' => 'numeric',
            'email_empresa' => 'email',
        ]);

        $empresa->update($request->all());
        return response()->json(['data' => $empresa], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        return response(null, 204);
    }

}
