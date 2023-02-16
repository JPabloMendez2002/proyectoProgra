<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParametrosServiciosController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MonitoreoServidorController;
use App\Http\Controllers\MonitoreoServicioController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\ParametrosServidoresController;

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

Route::post('usuarios', [UsuarioController::class, 'store']);

Route::resource('servidores', ServidorController::class)->parameters(['servidores'=>'IdServidor']);

Route::resource('servicios', ServicioController::class)->parameters(['servicios'=>'IdServicio']);

Route::post("enviar", [EmailsController::class, "enviarEmails"])->name("enviar");

