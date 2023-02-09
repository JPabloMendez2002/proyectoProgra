<?php

namespace App\Http\Controllers;

use App\Models\Servidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servidores = Servidor::all();
        $datos = [];

        foreach ($servidores as $servidor) {
            $datos[] = [
                'ID' => $servidor->IdServidor,
                'Nombre' => $servidor->Nombre,
                'Descripcion' => $servidor->Descripcion,
                'Contrasena' => $servidor->Contrasena,
                'Notificaciones' => $servidor->Notificaciones
            ];
        }

        if (!empty($servidores)) {
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
            $servidor = new Servidor();

            $reglas = [
                'Nombre' => 'required|string',
                'Descripcion' => 'required|string',
                'Contrasena' => 'required|string',
                'Notificaciones' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $reglas);

            if ($validator->fails()) {
                $mensaje = [
                    'Mensaje' => "No pueden existir campos vacíos",
                    'Error' => $validator->errors()->all()
                ];

                return response()->json($mensaje);
            } else {
                $servidor->Nombre = $request->Nombre;
                $servidor->Descripcion = $request->Descripcion;
                $servidor->Contrasena = sha1($request->Contrasena);
                $servidor->Notificaciones = $request->Notificaciones;
                $servidor->save();

                $mensaje = [
                    'Respuesta del Servidor' => "201 Created",
                    'Mensaje' => "Rol agregado correctamente",
                    'Datos' => $servidor
                ];

                return response()->json($mensaje);
            }
        } catch (\Throwable $th) {
            $mensaje = [
                'Respuesta del Servidor' => "Error 409 Conflict",
                'Mensaje' => "El servidor '{$request->Nombre}' ya se encuentra registrado"
            ];

            return response()->json($mensaje);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servidor  $servidor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $servidor = Servidor::find($request->IdServidor);

        if (!empty($servidor)) {
            $mensaje = [
                'Respuesta del Servidor' => "200 OK",
                'ID' => $servidor->IdServidor,
                'Nombre' => $servidor->Nombre,
                'Descripcion' => $servidor->Descripcion,
                'Contrasena' => $servidor->Contrasena,
                'Notificaciones' => $servidor->Notificaciones
            ];

            return response()->json($mensaje);
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el rol con ID: {$request->IdServidor}"
            ];

            return response()->json($mensaje);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servidor  $servidor
     * @return \Illuminate\Http\Response
     */
    public function edit(Servidor $servidor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servidor  $servidor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $servidor = Servidor::find($request->IdServidor);

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
                $servidor->Nombre = $request->Nombre;
                $servidor->Descripcion = $request->Descripcion;
                $servidor->Contrasena = $request->Contrasena;
                $servidor->Notificaciones = $request->Notificaciones;
                $servidor->save();

                $mensaje = [
                    'Respuesta del Servidor' => "200 OK",
                    'Mensaje' => "Se actualizaron los datos correctamente",
                    'ID' => $servidor->IdServidor,
                    'Nombre' => $servidor->Nombre,
                    'Descripcion' => $servidor->Descripcion,
                    'Contrasena' => $servidor->Contrasena,
                    'Notificaciones' => $servidor->Notificaciones

                ];

                return response()->json($mensaje);
            }
        } catch (\Throwable $th) {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el rol con ID: {$request->IdServidor}"
            ];

            return response()->json($mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servidor  $servidor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $servidor = Servidor::destroy($request->IdServidor);

        if ($servidor) {
            $mensaje = [
                'Respuesta del Servidor' => "200 OK",
                'Mensaje' => "Se elimino el rol con ID: {$request->IdServidor}"
            ];

            return response()->json($mensaje);
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el rol con ID: {$request->IdServidor}"
            ];

            return response()->json($mensaje);
        }
    }
}
