<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AlquilerApiController;
use App\Http\Controllers\API\ProductoApiController;

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
    });
});