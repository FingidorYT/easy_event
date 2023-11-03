<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use carbon\carbon;
use Auth;

class AuthController extends Controller
{
    /**
     * Registro de usuario
     */
    public function signUp(Request $request)
    {
        $request->validate([
            'rol_id' => 'required|numeric',
            'cedula' => 'required|numeric|unique:users',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required|numeric',
            'password' => 'required|string'


        ]);

        $user=User::create([
            'rol_id' => $request->rol_id,
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'fecha_nacimiento' => Carbon::parse($request->fecha_nacimiento)->format('Y-m-d'),
            'telefono' => $request->telefono,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function signUpEmpresario(Request $request)
    {
        $request->validate([
            'rol_id' => 'required|string',
            'cedula' => 'required|unique:users',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required',
            'password' => 'required|string',
            'nit_empresa' => 'required|numeric|unique:empresas',
            'direccion_empresa' => 'required|string',
            'nombre_empresa' => 'required|string',
            'telefono_empresa' => 'required|numeric|unique:empresas',
            'email_empresa' => 'required|string|unique:empresas',
        ]);

        Empresa::create([
            'nit_empresa' => $request->rol_id,
            'direccion_empresa' => $request->cedula,
            'nombre_empresa' => $request->nombre,
            'telefono_empresa' => $request->telefono,
            'email_empresa' => $request->email,
            'usario_id' => $user->id,
        ]);

        $user=User::create([
            'rol_id' => $request->rol_id,
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'fecha_nacimiento' => Carbon::parse($request->fecha_nacimiento)->format('Y-m-d'),
            'telefono' => $request->telefono,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }
  
    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Obtener el objeto User como json
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
