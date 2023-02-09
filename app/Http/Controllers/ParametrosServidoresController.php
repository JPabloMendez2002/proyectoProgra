<?php

namespace App\Http\Controllers;

use App\Models\Parametros_Servidores;
use Illuminate\Http\Request;

class ParametrosServidoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parametrosServidores = Parametros_Servidores::all();

        $datos = [];
        foreach ($parametrosServidores as $parametroServidor) {
            $datos[] = [
                'ID' => $parametroServidor->IdParametroServidor,
                'Nombre' => $parametroServidor->Nombre,
                'Descripcion' => $parametroServidor->Descripcion
            ];
        }

        return response()->json($datos);
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
            $parametro = new Parametros_Servidores();

            $parametro->Nombre = $request->Nombre;
            $parametro->Descripcion = $request->Descripcion;
            $parametro->save();

            $mensaje = [
                'Respuesta del Servidor' => "201 Created",
                'Mensaje' => "Parametro agregado correctamente",
                'Datos' => $parametro
            ];

            return response()->json($mensaje);
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
     * @param  \App\Models\Parametros_Servidores  $parametros_Servidores
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $parametro = Parametros_Servidores::find($request->IdParametroServidor);

        if (!empty($parametro)) {
            return response()->json($parametro);
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el parametro con ID: {$request->IdParametroServidor}"
            ];

            return response()->json($mensaje);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parametros_Servidores  $parametros_Servidores
     * @return \Illuminate\Http\Response
     */
    public function edit(Parametros_Servidores $parametros_Servidores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parametros_Servidores  $parametros_Servidores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $parametro = Parametros_Servidores::find($request->IdParametroServidor);

        if (!empty($parametro)) {
            if ($request->Descripcion != "") {
                $parametro->descripcion = $request->Descripcion;
                $parametro->save();

                $mensaje = [
                    'Respuesta del Servidor' => "200 OK",
                    'Mensaje' => "Se actualizaron los datos correctamente",
                    'ID' => $parametro->IdParametroServidor,
                    'Descripcion' => $parametro->descripcion
                ];

                return response()->json($mensaje);
            } else {
                $mensaje = [
                    'Respuesta del Servidor' => "Error 500",
                    'Mensaje' => "No se permiten nombres ni descripciones vacias"
                ];

                return response()->json($mensaje);
            }
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el parametro con ID: {$request->IdParametroServidor}"
            ];

            return response()->json($mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parametros_Servidores  $parametros_Servidores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $parametro = Parametros_Servidores::destroy($request->IdParametroServidor);

        if ($parametro) {
            $mensaje = [
                'Respuesta del Servidor' => "200 OK",
                'Mensaje' => "Se elimino el parametro con ID: {$request->IdParametroServidor}"
            ];

            return response()->json($mensaje);
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el parametro con ID: {$request->IdParametroServidor}"
            ];

            return response()->json($mensaje);
        }
    }
}
