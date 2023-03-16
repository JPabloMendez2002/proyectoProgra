<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\MonitoreoServidor;
use App\Models\Servidor;
use App\Models\Servicio;

class MonitoreoServidorController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'IdServidor' => 'required|integer',
            'UsoCPU' => 'required|integer',
            'UsoMemoria' => 'required|integer',
            'UsoDisco' => 'required|integer',
            'Servicios' => 'required|array'
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $errores =  implode(" ", $validator->errors()->all());

            Storage::append('errorsclient.log', $errores);

            abort(code: 400, message: "No pueden existir campos vacíos: {$errores}");
        } else {
            $validaServicios = 0;
            $monitoreoServidor = new MonitoreoServidor();
            $servidor = Servidor::find($request->IdServidor);

            if (!empty($servidor)) {

                $datos = $request->Servicios;

                for ($i = 0; $i < count($datos); $i++) {

                    $servicio = Servicio::join('Servidores', 'Servicios.IdServidor', '=', 'Servidores.IdServidor')->select('Servicios.IdServicio')->where('Servicios.IdServidor', $request->IdServidor)->get();

                    if (!empty($servicio)) {
                        if ($servicio[$i]['IdServicio'] == $datos[$i]['IdServicio']) {
                            $validaServicios++;
                        }
                    }
                }

                if ($validaServicios > 1) {
                    $monitoreoServidor->IdServidor = $request->IdServidor;
                    $monitoreoServidor->FechaMonitoreo = date('Y-m-d H:i:s');
                    $monitoreoServidor->UsoCpu = $request->UsoCPU;
                    $monitoreoServidor->UsoMemoria = $request->UsoMemoria;
                    $monitoreoServidor->UsoDisco = $request->UsoDisco;
                    $monitoreoServidor->save();
                    $idmonitoreo = $monitoreoServidor->IdMonitoreo;

                    for ($i = 0; $i < count($datos); $i++) {
                        $datos[$i] += ["IdMonitoreo" => $idmonitoreo];
                        $datos[$i] += ["FechaMonitoreo" => date('Y-m-d H:i:s')];
                        $datos[$i] += ["FechaMonitoreo" => date('Y-m-d H:i:s')];
                        $datos[$i] += ["Timeout" => rand(1, 10)];
                        $datos[$i] += ["created_at" => now()];
                        $datos[$i] += ["updated_at" => now()];
                    }

                    DB::table('Monitoreo_Servicio')->insert($datos);

                    $mensaje = [
                        'Respuesta del Servidor' => "Monitoreo registrado correctamente",
                        'Datos creados' => $monitoreoServidor
                    ];

                    return response()->json($mensaje, 201);
                } else {
                    abort(code: 404, message: "Algún servicio indicado no existe en este servidor");
                }
            } else {
                abort(code: 404, message: "El servidor con ID '{$request->IdServidor}' no existe");
            }
        }
    }
}
