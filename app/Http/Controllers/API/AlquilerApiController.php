<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alquiler;
use App\Models\Empresa;
use App\Models\AlquilerHasProducto;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AlquilerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $rol_id = $user->rol_id;
        if($rol_id == 1){
            $alquileres = Alquiler::all();
            return response()->json(['Alquileres' => $alquileres]);
        }elseif($rol_id == 2){
            $empresa = $user->empresa;
            $alquileres = DB::table('alquilers as al')
            ->join('alquiler_has_productos as ap', 'al.id', '=', 'ap.alquiler_id')
            ->join('productos as pr', 'ap.producto_id', '=', 'pr.id')
            ->join('empresas as em', 'pr.empresa_id', '=', 'em.id')
            ->join('users as us', 'al.user_id', '=', 'us.id')
            ->select('al.*', 'us.nombre', 'us.apellido')
            ->distinct()
            ->where('pr.empresa_id', $empresa->id)
            ->where('estado_secuencia', 'activo')
            ->orWhere('estado_secuencia', 'finalizado')
            ->get();

            return response()->json(['Alquileres'=>$alquileres]);
           
        }elseif ($rol_id == 3 ) {

            $alquileres = Alquiler::where('user_id', $user->id)->where('estado_secuencia', 'Activo')->orWhere('estado_secuencia', 'Inactivo')->orWhere('estado_secuencia', 'Finalizado')->get();
            return response()->json(['Alquileres' => $alquileres]);

        }
        return response()->json(['mensaje' => 'No autorizado'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $rol_id = $user->rol_id;
        if($rol_id == 3){
             // Crear el alquiler.
            $alquileres = Alquiler::where('user_id', $user->id)->count();

            if ($alquileres >= 3){
                return response()->json(['mensaje' => 'Tienes muchos alquileres pendientes, espera que te responda el empresario o cancela el pedido'], 200);
            }

           Alquiler::create([
            'user_id' => $user->id,
           ]);

            // Puedes devolver una respuesta adecuada, por ejemplo, el ID del nuevo alquiler.
            return response()->json(['mensaje' => 'Alquiler creado exitosamente'], 201);
        }

        return response()->json(['mensaje' => 'No autorizado'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = Auth::user();
        $rol_id = $user->rol_id;

        if($rol_id==2){
            $alquiler = DB::table('alquilers as al')
            ->join('alquiler_has_productos as ap', 'al.id', '=', 'ap.alquiler_id')
            ->join('productos as pr', 'ap.producto_id', '=', 'pr.id')
            ->join('empresas as em', 'pr.empresa_id', '=', 'em.id')
            ->join('users as us', 'al.user_id', '=', 'us.id')
            ->select('al.*', 'us.nombre', 'us.apellido', 'us.telefono', 'us.foto')
            ->distinct()
            ->where('al.id', $id)
            ->first();
            
        
            $productos = DB::table('alquilers as al')
            ->join('alquiler_has_productos as ap', 'al.id', '=', 'ap.alquiler_id')
            ->join('productos as pr', 'ap.producto_id', '=', 'pr.id')
            ->join('empresas as em', 'pr.empresa_id', '=', 'em.id')
            ->join('users as us', 'al.user_id', '=', 'us.id')
            ->select('pr.*','ap.*','ap.precio as precio', 'ap.producto_Id as id')
            ->distinct()
            ->where('al.id', $id)
            ->get();

            foreach($productos as $producto){
                $producto->precio_producto_total = $producto->precio * $producto->cantidad_recibida;
            }

            $alquiler->productos = $productos;

            return response()->json($alquiler, 200); 

        }else{
            return;
        }
        

    }

    public function contarAlquileres ()
    {
        // Mostrar alquileres según el estado y/o usuario (para el área de administrador).
        $user = Auth::user();
        $rol_id = $user->rol_id;
        //return response()->json($rol_id);
        if($rol_id==2){
                $empresa = $user->empresa; 
                $alquileres_solicitados = DB::table('alquilers as al')
                ->join('alquiler_has_productos as ap', 'al.id', '=', 'ap.alquiler_id')
                ->join('productos as pr', 'ap.producto_id', '=', 'pr.id')
                ->join('empresas as em', 'pr.empresa_id', '=', 'em.id')
                ->join('users as us', 'al.user_id', '=', 'us.id')
                ->select('al.*', 'us.nombre', 'us.apellido')
                ->distinct()
                ->where('pr.empresa_id', $empresa->id)
                ->where('al.estado_pedido', "solicitud")
                ->get()
                ->count();

                $alquileres_entregados = DB::table('alquilers as al')
                ->join('alquiler_has_productos as ap', 'al.id', '=', 'ap.alquiler_id')
                ->join('productos as pr', 'ap.producto_id', '=', 'pr.id')
                ->join('empresas as em', 'pr.empresa_id', '=', 'em.id')
                ->join('users as us', 'al.user_id', '=', 'us.id')
                ->select('al.*', 'us.nombre', 'us.apellido')
                ->distinct()
                ->where('pr.empresa_id', $empresa->id)
                ->where('al.estado_pedido', "entregado")
                ->count();
                
                return response()->json(['alquileres_entregados' => $alquileres_entregados,  'alquileres_solicitados'=> $alquileres_solicitados], 200);            
        }else{

            return response()->json(['Alquileres' => 'No autorizado'], 200);

        }

    }

    public function filtrarAlquileres (Request $request)
    {
        // Mostrar alquileres según el estado y/o usuario (para el área de administrador).
        $user = Auth::user();
        $rol_id = $user->rol_id;
        $estado = $request->estado;
        if($rol_id==2){
                $empresa = $user->empresa;
                $alquileres = DB::table('alquilers as al')
                ->join('alquiler_has_productos as ap', 'al.id', '=', 'ap.alquiler_id')
                ->join('productos as pr', 'ap.producto_id', '=', 'pr.id')
                ->join('empresas as em', 'pr.empresa_id', '=', 'em.id')
                ->join('users as us', 'al.user_id', '=', 'us.id')
                ->select('al.*', 'us.nombre', 'us.apellido', 'us.telefono', 'us.foto')
                ->distinct()
                ->where('pr.empresa_id', $empresa->id)
                ->where('al.estado_pedido', $estado)
                ->get();
                
                return response()->json(['Alquileres' => $alquileres], 200); 

        }else if ($rol_id ==3 ){
            $alquiler = Alquiler::where('user_id', $user->id)->where('estado_pedido',$estado)->first();
            if ($estado == "carrito"){ 
                $alquileres = DB::table('alquilers as al')
                    ->join('alquiler_has_productos as ap', 'al.id', '=', 'ap.alquiler_id')
                    ->join('productos as pr', 'ap.producto_id', '=', 'pr.id')
                    ->join('empresas as em', 'pr.empresa_id', '=', 'em.id')
                    ->join('users as us', 'al.user_id', '=', 'us.id')
                    ->select('pr.*', 'ap.cantidad_recibida')
                    ->distinct()
                    ->where('al.user_id', $user->id)
                    ->where('al.estado_pedido', $estado)
                    ->get();
                
                    $precio_subtotal = DB::table('alquiler_has_productos')
                        ->where('alquiler_id', $alquiler->id)
                        ->join('productos', 'alquiler_has_productos.producto_id', '=', 'productos.id')
                        ->sum(DB::raw('productos.precio * alquiler_has_productos.cantidad_recibida'));

                $alquiler_has_productos = AlquilerHasProducto::where('', '');

                foreach($alquileres as $alquil){

                    $empresa = Empresa::find($alquil->empresa_id);
                    $producto = Producto::find($alquil->id);
                    $alquil->precio = $producto->precio;
                    $alquil->nombre_empresa = $empresa->nombre_empresa;
                    $alquil->precio_producto_total = $producto->precio * $alquil->cantidad_recibida;
                    
                }       
                


            }else if ($estado == "solicitud"){
                $alquileres = DB::table('alquilers as al')
                    ->join('alquiler_has_productos as ap', 'al.id', '=', 'ap.alquiler_id')
                    ->join('productos as pr', 'ap.producto_id', '=', 'pr.id')
                    ->join('empresas as em', 'pr.empresa_id', '=', 'em.id')
                    ->join('users as us', 'al.user_id', '=', 'us.id')
                    ->select('pr.*', 'ap.cantidad_recibida','ap.precio as precio_viejo')
                    ->distinct()
                    ->where('al.user_id', $user->id)
                    ->where('al.estado_pedido', $estado)
                    ->get();

                    $precio_subtotal = DB::table('alquiler_has_productos')
                        ->where('alquiler_id', $alquiler->id)
                        ->join('productos', 'alquiler_has_productos.producto_id', '=', 'productos.id')
                        ->sum(DB::raw('alquiler_has_productos.precio * alquiler_has_productos.cantidad_recibida'));

                        foreach($alquileres as $alquil){

                            $empresa = Empresa::find($alquil->empresa_id);
                            $alquil->nombre_empresa = $empresa->nombre_empresa;
                            $alquil->precio_producto_total = $alquil->precio * $alquil->cantidad_recibida;
            
                        }
                     
            }

           
                
                return response()->json(['alquiler_id'=>$alquiler->id,'precio_alquiler'=>$precio_subtotal, 'Producto' => $alquileres], 200);

        }else{

            return response()->json(['Alquileres' => 'No autorizado'], 200);

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        // Actualizar un alquiler existente (para el área de administrador).
        $user = Auth::user();
        

        if($user->rol_id == 2){
            $respuesta = $request->respuesta;

            $empresa = $user->empresa;
            $alquiler =  DB::table('alquilers as al')
            ->join('alquiler_has_productos as ap', 'al.id', '=', 'ap.alquiler_id')
            ->join('productos as pr', 'ap.producto_id', '=', 'pr.id')
            ->join('empresas as em', 'pr.empresa_id', '=', 'em.id')
            ->join('users as us', 'al.user_id', '=', 'us.id')
            ->select('al.*', 'us.nombre', 'us.apellido', 'us.telefono', 'us.foto')
            ->distinct()
            ->where('pr.empresa_id', $empresa->id)
            ->where('al.id', $id)
            ->first();

            switch ($respuesta){

                case "rechazar":
                    $alquilerup = Alquiler::find($alquiler->id);
                    $alquilerup->estado_pedido = "rechazado";
                    $alquilerup->estado_secuencia = "Finalizado";
                    $alquilerup->save();
                    return response()->json(['Alquiler rechazado correctamente' => $alquilerup], 200);
                    break;

                case "aceptar":
                    $alquilerup = Alquiler::find($alquiler->id);
                    if($alquilerup->lugar_entrega != "Recoger"){
                        $alquilerup->precio_envio = $request->precio_envio;
                        $alquilerup->precio_alquiler = $alquilerup->precio_alquiler +  $request->precio_envio;
                        $alquilerup->estado_pedido = "aceptado_empresario";
                        $alquilerup->estado_secuencia = "Inactivo";
                        $alquilerup->save();
                        return response()->json(['Alquiler aceptado correctamente' => $alquilerup], 200);
                    }else{
                        $alquilerup->estado_pedido = "Aceptado";
                        $alquilerup->estado_secuencia = "Activo";
                        $alquilerup->save();
                        return response()->json(['Alquiler aceptado correctamente' => $alquilerup], 200);
                    }
                    break;

                case "aceptar_modificacion":
                    $alquilerup = Alquiler::find($alquiler->id);
                    $alquilerup->estado_pedido = "aceptado_empresario";
                    $alquilerup->estado_secuencia = "Inactivo";
                    $alquilerup->save();
                    return response()->json(['Alquiler aceptado con modificaciones correctamente' => $alquilerup], 200);
                    break;

            }

        } else if($user->rol_id == 3){
            $alquiler = Alquiler::where('user_id', $user->id)->where('estado_pedido', "carrito")->where('estado_secuencia', "Inactivo")->where('id', $id)->first();
            $respuesta = $request->respuesta;
        
            if($alquiler){
                $alquileres = DB::table('alquilers as al')
                        ->join('alquiler_has_productos as ap', 'al.id', '=', 'ap.alquiler_id')
                        ->join('productos as pr', 'ap.producto_id', '=', 'pr.id')
                        ->join('empresas as em', 'pr.empresa_id', '=', 'em.id')
                        ->join('users as us', 'al.user_id', '=', 'us.id')
                        ->select('pr.*', 'ap.cantidad_recibida')
                        ->distinct()
                        ->where('al.user_id', $user->id)
                        ->where('ap.alquiler_id', $id)
                        ->get();
                        
                    $relaciones = AlquilerHasProducto::where('alquiler_id', $id)->get();
                    
                    foreach($relaciones as $relacion){
                        $producto = Producto::find($relacion->producto_id);
                        $relacion->precio = $producto->precio;
                        $relacion->save();
                    }       

                $precio_subtotal = DB::table('alquiler_has_productos')
                            ->where('alquiler_id', $alquiler->id)
                            ->join('productos', 'alquiler_has_productos.producto_id', '=', 'productos.id')
                            ->sum(DB::raw('alquiler_has_productos.precio * alquiler_has_productos.cantidad_recibida'));

                // Actualizar el alquiler.
                $alquiler->estado_pedido = "solicitud";
                $alquiler->metodo_pago = $request->metodo_pago;
                $alquiler->lugar_entrega = $request->lugar_entrega;
                $alquiler->fecha_alquiler = $request->fecha_alquiler;
                $alquiler->fecha_devolucion = $request->fecha_devolucion;
                $alquiler->precio_alquiler = $precio_subtotal;    
                $alquiler->update();
                // Devolver la respuesta actualizada.
                return response()->json(['mensaje' => 'Alquiler actualizado exitosamente', 'alquiler' => $alquiler], 200);
                
            

            } else {
                return response()->json(['mensaje' => 'No tiene alquileres pendientes'], 404);

            }
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

    public function carrito(Request $request){
        $user = Auth::user();
        $producto_id = $request->id;
        $producto = Producto::find($producto_id);
        $precio = $producto->precio;
        $cantidad_producto = $request->cantidad;
        

        $alquiler = Alquiler::where('user_id', $user->id)->where('estado_pedido', 'carrito')->first();
        if ($alquiler){

            $relacion = AlquilerHasProducto::where('alquiler_id', $alquiler->id)->where('producto_id', $producto_id)->first();
            if($relacion){

                $relacion->cantidad_recibida = $cantidad_producto;
                $relacion->precio = $precio;
                $relacion->save();
                return response()->json(['mensaje' => $relacion], 200);

            }else {
                $relacion = AlquilerHasProducto::create([
                    'alquiler_id' => $alquiler->id,
                    'producto_id' => $producto_id,
                    'cantidad_recibida' => $cantidad_producto,
                    'precio' => $precio,
                ]);
                return response()->json(['producto creado' => $relacion], 200);
            }
            
        } else {
            $alquiler = Alquiler::create([
                'user_id' => $user->id,
            ]);

            if ($alquiler){

                $relacion = AlquilerHasProducto::where('alquiler_id', $alquiler->id)->where('producto_id', $producto_id)->first();
            if($relacion){

                $relacion->cantidad_recibida = $relacion->cantidad_recibida + $cantidad_producto;
                $relacion->precio = $precio;
                $relacion->save();
                return response()->json(['mensaje' => $relacion], 200);

            }else {
                $relacion = AlquilerHasProducto::create([
                    'alquiler_id' => $alquiler->id,
                    'producto_id' => $producto_id,
                    'cantidad_recibida' => $cantidad_producto,
                    'precio' => $precio,
                ]);
                return response()->json(['producto creado' => $relacion], 200);
            }

            } else {
                return response()->json(['Error'], 404);
            }

        }
    }

    public function deletecarrito(Request $request){
         $user = Auth::user();
         if ($user->rol_id == 2){
            
         }

    }
}
