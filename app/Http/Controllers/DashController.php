<?php

namespace App\Http\Controllers;

use App\Models\Servidor;
use App\Models\Servicio;

class DashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::all();

        $monitoreos = Servidor::join('Monitoreo_Servidor', 'Monitoreo_Servidor.IdServidor', '=', 'Servidores.IdServidor')->select('Monitoreo_Servidor.IdMonitoreo', 'Monitoreo_Servidor.FechaMonitoreo', 'Servidores.IdServidor AS ID Servidor', 'Servidores.Nombre AS Nombre Servidor', 'Monitoreo_Servidor.UsoCpu', 'Monitoreo_Servidor.UsoMemoria', 'Monitoreo_Servidor.UsoDisco')->get();

        if (!empty($monitoreos)) {

            foreach ($servicios as $servicio) {
                $serviciosMostrar[] = [
                    "ID del Servidor" => $servicio->IdServidor,
                    "Nombre del servicio" => $servicio->Nombre,
                    "Estado" => 'Activo'
                ];
            }

            if (!empty($serviciosMostrar)) {
                $datos[] = [
                    "Informacion de los Servidorores" => $monitoreos,
                    "Informacion de los Servicios" => $serviciosMostrar
                ];

                return response()->json($datos, 200);
            } else {
                $mensaje = [
                    'Respuesta del Servidor' => "No hay datos por mostrar",
                ];

                return response()->json($mensaje, 200);
            }
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "No hay datos por mostrar",
            ];

            return response()->json($mensaje, 200);
        }
    }
}
