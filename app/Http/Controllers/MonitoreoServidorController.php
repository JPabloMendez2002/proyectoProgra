<?php

namespace App\Http\Controllers;

use App\Models\MonitoreoServidor;
use Illuminate\Http\Request;

class MonitoreoServidorController extends Controller
{
    public function index()
    {
        $monitoreos = MonitoreoServidor::all();
        $datos = [];

        foreach ($monitoreos as $monitoreo) {
            $datos[] = [
                'IdServidor' => $monitoreo->IdServidor,
                'Uso CPU' => $monitoreo->UsoCpu,
                'Uso Memoria' => $monitoreo->UsoMemoria,
                'Uso Disco' => $monitoreo->UsoDisco,
                'Fecha Monitoreo' => $monitoreo->FechaMonitoreo
            ];
        }

        if (!empty($monitoreos)) {
            return response()->json($datos);
        } else {
            $mensaje = [
                'Mensaje' => "No hay datos por mostrar",
            ];

            return response()->json($mensaje);
        }
    }
}
