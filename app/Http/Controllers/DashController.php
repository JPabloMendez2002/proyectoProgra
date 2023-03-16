<?php

namespace App\Http\Controllers;

use App\Models\Servidor;
use App\Models\Servicio;
use App\Models\MonitoreoServicio;
use App\Models\MonitoreoServidor;
use App\Models\EncargadoServicio;
class DashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $monitoreos = Servidor::join('Monitoreo_Servidor', 'Monitoreo_Servidor.IdServidor', '=', 'Servidores.IdServidor')->select('Monitoreo_Servidor.IdMonitoreo', 'Monitoreo_Servidor.FechaMonitoreo', 'Servidores.IdServidor AS ID Servidor', 'Servidores.Nombre AS Nombre Servidor', 'Monitoreo_Servidor.UsoCpu', 'Monitoreo_Servidor.UsoMemoria', 'Monitoreo_Servidor.UsoDisco')->get();

        $servicios = Servicio::join('Monitoreo_Servicio', 'Monitoreo_Servicio.IdServicio', '=', 'Servicios.IdServicio')->select('Monitoreo_Servicio.IdMonitoreo','Servicios.IdServicio AS ID Servicio', 'Monitoreo_Servicio.Disponibilidad', 'Monitoreo_Servicio.Descripcion', 'Monitoreo_Servicio.Timeout')->get();

        if (!empty($monitoreos)) {

            if (!empty($servicios)) {
                $datos[] = [
                    "Informacion de los Servidorores" => $monitoreos,
                    "Informacion de los Servicios" => $servicios
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


    public function ServicioDash(){

        $monitoreoServidor = MonitoreoServidor::JOIN('Monitoreo_Servicio', 'Monitoreo_Servidor.IdMonitoreo', '=','Monitoreo_Servicio.IdMonitoreo')
        ->JOIN('Encargado_Servicio', 'Monitoreo_Servicio.IdServicio', '=','Encargado_Servicio.IdServicio')
        ->JOIN('Usuarios','Encargado_Servicio.IdEncargado', '=', 'Usuarios.IdUsuario')
        ->WHERE('Monitoreo_Servicio.Disponibilidad', '=', 0)
        ->select('Usuarios.NombreCompleto AS Encargado','Monitoreo_Servicio.IdServicio')
        ->get();

        $monitoreos = Servidor::join('Monitoreo_Servidor', 'Monitoreo_Servidor.IdServidor', '=', 'Servidores.IdServidor')->select('Monitoreo_Servidor.IdMonitoreo', 'Monitoreo_Servidor.FechaMonitoreo', 'Servidores.IdServidor AS ID Servidor', 'Servidores.Nombre AS Nombre Servidor', 'Monitoreo_Servidor.UsoCpu', 'Monitoreo_Servidor.UsoMemoria', 'Monitoreo_Servidor.UsoDisco')->get();
        $servicios = Servicio::join('Monitoreo_Servicio', 'Monitoreo_Servicio.IdServicio', '=', 'Servicios.IdServicio')->select('Monitoreo_Servicio.IdMonitoreo','Servicios.IdServicio AS ID Servicio', 'Monitoreo_Servicio.Disponibilidad', 'Monitoreo_Servicio.Descripcion', 'Monitoreo_Servicio.Timeout')->get();

        //echo $monitoreoServidor;
        if (!empty($monitoreos)) {

            if (!empty($servicios)) {

                if (!empty($monitoreoServidor)) {

                    $datos[] = [
                        "Informacion de los Servidores" => $monitoreos,
                        "Informacion de los Servicios" => $servicios,
                        "Servicios con problemas" => $monitoreoServidor
                    ];
    
                    return response()->json($datos, 200);

                }else{
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
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "No hay datos por mostrar",
            ];

            return response()->json($mensaje, 200);
        }
    }
}
