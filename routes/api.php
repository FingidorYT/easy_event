<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AlquilerApiController;
use App\Http\Controllers\API\ProductoApiController;
use App\Http\Controllers\API\FavoritoApiController;
use App\Http\Controllers\API\CategoriaApiController;
use App\Http\Controllers\API\EmpresaApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'signUp']);
    Route::post('signup_empresario', [AuthController::class,'signUpEmpresario']);
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::apiResource('producto', ProductoApiController::class);
        Route::post('alquiler', [AlquilerApiController::class, 'show']);
        Route::post('alquiler/actualizar', [AlquilerApiController::class, 'update']);
        Route::post('alquiler/guardar', [AlquilerApiController::class, 'store']);
        Route::get('logout', [AuthController::class,'logout']);
        Route::get('user', [AuthController::class,'user']);
        Route::get('producto', [ProductoApiController::class, 'index']);
        Route::post('producto', [ProductoApiController::class, 'store']);
        Route::get('producto/search', [ProductoApiController::class, 'search']);
        Route::put('producto/{id}',[ProductoApiController::class, 'update']);
        Route::delete('producto/{id}', [ProductoApiController::class, 'destroy']);
        Route::post('/agregar-favorito/{producto}', [FavoritoApiController::class, 'agregarFavorito']);
        Route::post('/eliminar-favorito/{producto}', [FavoritoApiController::class, 'eliminarFavorito']);
    });
});