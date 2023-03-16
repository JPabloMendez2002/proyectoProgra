<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\UmbralController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\ParametroServidorController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\IniciarDetenerController;
use App\Http\Controllers\MonitoreoServidorController;
use App\Http\Controllers\EncargadoServicioController;
use App\Http\Controllers\EncargadoServidorController;
use App\Http\Controllers\AlertaServidorController;

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

Route::post('umbrales', [UmbralController::class, 'store']);

Route::post('componentes', [ComponenteController::class, 'store']);

Route::post('monitoreoservidor', [MonitoreoServidorController::class, 'store']);

Route::resource('parametrosservidor', ParametroServidorController::class)->parameters(['parametrosservidor'=>'IdParametro']);;

Route::get('dash', [DashController::class, 'index']);

Route::get('ServicioDash', [DashController::class, 'ServicioDash']);

Route::get('dash/vista', [DashController::class, 'dashVista']);

Route::get('dash/vista/servicios/{idServidor}', [DashController::class, 'dashVistaServicios']);

Route::post("alertaservidor", [EmailsController::class, "enviarEmailServidor"])->name("alertaservidor");

Route::post("alertaservicio", [EmailsController::class, "enviarEmailServicio"])->name("alertaservicio");

Route::put('alertas/servicio/{IdEncargado}', [IniciarDetenerController::class, 'updateAlertaServicio']);

Route::put('alertas/servidor/{IdEncargado}', [IniciarDetenerController::class, 'updateAlertaServidor']);

Route::put('alerta/servidor/{IdServidor}', [AlertaServidorController::class, 'update']);

Route::post('encargadoservicio', [EncargadoServicioController::class, 'store']);

Route::post('encargadoservidor', [EncargadoServidorController::class, 'store']);
