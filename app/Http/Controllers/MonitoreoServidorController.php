<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MonitoreoServidor;
use App\Models\Servidor;

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
            // 'UsoCpu' => 'required|integer',
            // 'UsoMemoria' => 'required|integer',
            // 'UsoDisco' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $errores =  implode(" ", $validator->errors()->all());

            abort(code: 400, message: "No pueden existir campos vacíos: {$errores}");
        } else {
            $monitoreo = new MonitoreoServidor();
            $servidor = Servidor::find($request->IdServidor);

            if (!empty($servidor)) {
                $monitoreo->FechaMonitoreo = date('Y-m-d H:i:s');
                $monitoreo->IdServidor = $request->IdServidor;
                $monitoreo->UsoCpu = rand(1,90);
                $monitoreo->UsoMemoria = rand(1,90);
                $monitoreo->UsoDisco = rand(1,90);
                $monitoreo->save();

                $mensaje = [
                    'Respuesta del Servidor' => "Registro agregado correctamente",
                    'Datos creados' => $monitoreo
                ];

                return response()->json($mensaje, 201);
            } else {
                abort(code: 500, message: "El servidor con ID '{$request->IdServidor}' no existe");
            }
        }
    }
}
