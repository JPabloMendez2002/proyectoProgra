<?php

use App\Http\Controllers\IntervaloController;
use App\Http\Controllers\ParametrosServidoresController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ParametrosServiciosController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MonitoreoServidorController;
use App\Http\Controllers\MonitoreoServicioController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UsuarioController::class, 'login']);

Route::resource('roles', RolController::class)->parameters(['roles'=>'IdRol']);

Route::resource('intervalos', IntervaloController::class)->parameters(['intervalos' => 'IdIntervalo']);

Route::resource('parametrosservicios', ParametrosServiciosController::class)->parameters(['parametrosservicios'=>'IdParametroServicio']);

Route::resource('parametrosservidores', ParametrosServidoresController::class)->parameters(['parametrosservidores'=>'IdParametroServidor']);

Route::resource('servidores', ServidorController::class)->parameters(['servidores'=>'IdServidor']);

Route::resource('servicios', ServicioController::class)->parameters(['servicios'=>'IdServicio']);

Route::get('monitoreoservidores', [MonitoreoServidorController::class, 'index']);

Route::get('monitoreoservicios', [MonitoreoServicioController::class, 'index']);

