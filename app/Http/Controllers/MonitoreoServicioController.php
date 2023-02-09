<?php

namespace App\Http\Controllers;

use App\Models\MonitoreoServicio;
use Illuminate\Http\Request;

class MonitoreoServicioController extends Controller
{
    public function index()
    {
        $monitoreos = MonitoreoServicio::all();
        $datos = [];

        foreach ($monitoreos as $monitoreo) {
            $datos[] = [
                'IdServicio' => $monitoreo->IdServicio,
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
