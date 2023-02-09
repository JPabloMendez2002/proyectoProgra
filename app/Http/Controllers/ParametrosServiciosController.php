<?php

namespace App\Http\Controllers;

use App\Models\Parametros_Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParametrosServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parametrosServicios = Parametros_Servicios::all();
        $datos = [];

        foreach ($parametrosServicios as $parametroServicio) {
            $datos[] = [
                'ID' => $parametroServicio->IdParametroServicio,
                'Nombre' => $parametroServicio->Nombre,
                'Descripcion' => $parametroServicio->Descripcion
            ];
        }

        if (!empty($parametroServicio)) {
            return response()->json($datos);
        } else {
            $mensaje = [
                'Mensaje' => "No hay datos por mostrar",
            ];
            
            return response()->json($mensaje);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $parametro = new Parametros_Servicios();

            $reglas = [
                'Nombre' => 'required|string',
                'Descripcion' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $reglas);

            if ($validator->fails()) {
                $mensaje = [
                    'Mensaje' => "No pueden existir campos vacíos",
                    'Error' => $validator->errors()->all()
                ];

                return response()->json($mensaje);
            } else {

                $parametro->Nombre = $request->Nombre;
                $parametro->Descripcion = $request->Descripcion;
                $parametro->save();

                $mensaje = [
                    'Respuesta del Servidor' => "201 Created",
                    'Mensaje' => "Parametro agregado correctamente",
                    'Datos' => $parametro
                ];

                return response()->json($mensaje);
            }
        } catch (\Throwable $th) {
            $mensaje = [
                'Respuesta del Servidor' => "Error 409 Conflict",
                'Mensaje' => "El parametro '{$request->Nombre}' ya se encuentra registrado"
            ];

            return response()->json($mensaje);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parametros_Servicios  $parametros_Servicios
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $parametro = Parametros_Servicios::find($request->IdParametroServicio);

        if (!empty($parametro)) {
            $mensaje = [
                'Respuesta del Servidor' => "200 OK",
                'ID' => $parametro->IdParametroServicio,
                'Nombre' => $parametro->Nombre,
                'Descripcion' => $parametro->Descripcion
            ];

            return response()->json($mensaje);
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el parametro con ID: {$request->IdParametroServicio}"
            ];

            return response()->json($mensaje);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parametros_Servicios  $parametros_Servicios
     * @return \Illuminate\Http\Response
     */
    public function edit(Parametros_Servicios $parametros_Servicios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parametros_Servicios  $parametros_Servicios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $parametro = Parametros_Servicios::find($request->IdParametroServicio);

            $reglas = [
                'Nombre' => 'required|string',
                'Descripcion' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $reglas);

            if ($validator->fails()) {
                $mensaje = [
                    'Mensaje' => "No pueden existir campos vacíos",
                    'Error' => $validator->errors()->all()
                ];

                return response()->json($mensaje);
            } else {
                $parametro->Nombre = $request->Nombre;
                $parametro->Descripcion = $request->Descripcion;
                $parametro->save();

                $mensaje = [
                    'Respuesta del Servidor' => "200 OK",
                    'Mensaje' => "Se actualizaron los datos correctamente",
                    'ID' => $parametro->IdParametroServicio,
                    'Nombre' => $parametro->Nombre,
                    'Descripcion' => $parametro->Descripcion
                ];

                return response()->json($mensaje);
            }
        } catch (\Throwable $th) {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el parametro con ID: {$request->IdParametroServicio}"
            ];

            return response()->json($mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parametros_Servicios  $parametros_Servicios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $parametro = Parametros_Servicios::destroy($request->IdParametroServicio);

        if ($parametro) {
            $mensaje = [
                'Respuesta del Servidor' => "200 OK",
                'Mensaje' => "Se elimino el parametro con ID: {$request->IdParametroServicio}"
            ];

            return response()->json($mensaje);
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el parametro con ID: {$request->IdParametroServicio}"
            ];

            return response()->json($mensaje);
        }
    }
}
