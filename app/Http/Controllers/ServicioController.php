<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::all();
        $datos = [];

        foreach ($servicios as $servicio) {
            $datos[] = [
                'ID' => $servicio->IdServicio,
                'Nombre' => $servicio->Nombre,
                'Descripcion' => $servicio->Descripcion,
                'IdServidor' => $servicio->IdServidor,
                'Timeout' => $servicio->TimeoutRespuesta,
                'Estado' => $servicio->EstadoServicio
            ];
        }

        if (!empty($servicios)) {
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
            $servicio = new Servicio();

            $reglas = [
                'Nombre' => 'required|string',
                'Descripcion' => 'required|string',
                'IdServidor' => 'required|integer',
                'Estado' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $reglas);

            if ($validator->fails()) {
                $mensaje = [
                    'Mensaje' => "No pueden existir campos vacíos",
                    'Error' => $validator->errors()->all()
                ];

                return response()->json($mensaje);
            } else {
                $servicio->Nombre = $request->Nombre;
                $servicio->Descripcion = $request->Descripcion;
                $servicio->IdServidor = $request->IdServidor;
                $servicio->TimeoutRespuesta = date('i');
                $servicio->EstadoServicio = $request->Estado;

                $servicio->save();

                $mensaje = [
                    'Respuesta del servidor' => "201 Created",
                    'Mensaje' => "Rol agregado correctamente",
                    'Datos' => $servicio
                ];

                return response()->json($mensaje);
            }
        } catch (\Throwable $th) {
            // $mensaje = [
            //     'Respuesta del servidor' => "Error 409 Conflict",
            //     'Mensaje' => "El servicio '{$request->Nombre}' ya se encuentra registrado"
            // ];

            // return response()->json($mensaje);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $servicio = Servicio::find($request->IdServicio);

        if (!empty($servicio)) {
            $mensaje = [
                'Respuesta del servicio' => "200 OK",
                'ID' => $servicio->IdServicio,
                'Nombre' => $servicio->Nombre,
                'Descripcion' => $servicio->Descripcion,
                'IdServidor' => $servicio->IdServidor,
                'Timeout' => $servicio->TimeoutRespuesta,
                'Estado' => $servicio->EstadoServicio
            ];

            return response()->json($mensaje);
        } else {
            $mensaje = [
                'Respuesta del servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el rol con ID: {$request->IdServicio}"
            ];

            return response()->json($mensaje);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
        try {
            $servicio = Servicio::find($request->IdServicio);

            $reglas = [
                'Nombre' => 'required|string',
                'Descripcion' => 'required|string',
                'IdServidor' => 'required|integer',
                'Estado' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $reglas);

            if ($validator->fails()) {
                $mensaje = [
                    'Mensaje' => "No pueden existir campos vacíos",
                    'Error' => $validator->errors()->all()
                ];

                return response()->json($mensaje);
            } else {
                $servicio->Nombre = $request->Nombre;
                $servicio->Descripcion = $request->Descripcion;
                $servicio->IdServidor = $request->IdServidor;
                $servicio->TimeoutRespuesta = date('i');
                $servicio->EstadoServicio = $request->Estado;
                $servicio->save();

                $mensaje = [
                    'Respuesta del servidor' => "200 OK",
                    'Mensaje' => "Se actualizaron los datos correctamente",
                    'ID' => $servicio->IdServicio,
                    'Nombre' => $servicio->Nombre,
                    'Descripcion' => $servicio->Descripcion,
                    'IdServicio' => $servicio->IdServicio,
                    'Timeout' => $servicio->TimeoutRespuesta,
                    'Estado' => $servicio->EstadoServicio
                ];

                return response()->json($mensaje);
            }
        } catch (\Throwable $th) {
            $mensaje = [
                'Respuesta del servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el rol con ID: {$request->IdServicio}"
            ];

            return response()->json($mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $servicio = Servicio::destroy($request->IdServicio);

        if ($servicio) {
            $mensaje = [
                'Respuesta del servidor' => "200 OK",
                'Mensaje' => "Se elimino el rol con ID: {$request->IdServicio}"
            ];

            return response()->json($mensaje);
        } else {
            $mensaje = [
                'Respuesta del servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el rol con ID: {$request->IdServicio}"
            ];

            return response()->json($mensaje);
        }
    }
}
