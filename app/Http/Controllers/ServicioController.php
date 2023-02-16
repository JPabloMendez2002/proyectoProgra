<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Servidor;
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
                'ID Servidor' => $servicio->IdServidor,
                'Nombre' => $servicio->Nombre,
                'Descripcion' => $servicio->Descripcion,
                'Timeout' => $servicio->TimeoutRespuesta,
                'Tipo' => $servicio->Tipo
            ];
        }

        if (!empty($datos)) {
            return response()->json($datos, 200);
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "No hay datos por mostrar",
            ];

            return response()->json($mensaje, 200);
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
        $reglas = [
            'IdServidor' => 'required|integer',
            'Nombre' => 'required|string',
            'Descripcion' => 'required|string',
            'TimeoutRespuesta' => 'required|integer',
            'Tipo' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $errores =  implode(" ", $validator->errors()->all());

            abort(code: 400, message: "No pueden existir campos vacíos: {$errores}");
        } else {
            $servicio = new Servicio();
            $servidor = Servidor::find($request->IdServidor);

            if (!empty($servidor)) {
                try {
                    $servicio->IdServidor = $request->IdServidor;
                    $servicio->Nombre = $request->Nombre;
                    $servicio->Descripcion = $request->Descripcion;
                    $servicio->TimeoutRespuesta = $request->TimeoutRespuesta;
                    $servicio->Tipo = $request->Tipo;
                    $servicio->save();

                    $mensaje = [
                        'Respuesta del Servidor' => "Servicio agregado correctamente",
                        'Datos creados' => $servicio
                    ];

                    return response()->json($mensaje, 201);
                } catch (\Throwable $th) {
                    abort(code: 409, message: "El servicio '{$request->Nombre}' ya se encuentra registrado");
                }
            } else {
                abort(code: 500, message: "El servidor con ID '{$request->IdServidor}' no existe");
            }
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
        $servidor = Servidor::find($request->IdServicio);

        if (!empty($servidor)) {
            $servicios = Servicio::where('IdServidor', $request->IdServicio)->get();

            return response()->json($servicios, 200);
        } else {
            abort(code: 404, message: "No se encontraron servicios vinculados al servidor: {$request->IdServicio}");
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
    public function update(Request $request)
    {

        $reglas = [
            'IdServidor' => 'required|integer',
            'Nombre' => 'required|string',
            'Descripcion' => 'required|string',
            'TimeoutRespuesta' => 'required|integer',
            'Tipo' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $errores =  implode(" ", $validator->errors()->all());

            abort(code: 400, message: "No pueden existir campos vacíos: {$errores}");
        } else {
            $servicio = Servicio::find($request->IdServicio);

            if (!empty($servicio)) {
                $servidor = Servidor::find($request->IdServidor);

                if (!empty($servidor)) {
                    try {

                        $servicio->IdServidor = $request->IdServidor;
                        $servicio->Nombre = $request->Nombre;
                        $servicio->Descripcion = $request->Descripcion;
                        $servicio->TimeoutRespuesta = $request->TimeoutRespuesta;
                        $servicio->Tipo = $request->Tipo;
                        $servicio->save();

                        $mensaje = [
                            'Respuesta del Servidor' => "Se actualizaron los datos correctamente",
                            'ID' => $servicio->IdServicio,
                            'ID Servidor' => $servicio->IdServidor,
                            'Nombre' => $servicio->Nombre,
                            'Descripcion' => $servicio->Descripcion,
                            'Timeout' => $servicio->TimeoutRespuesta,
                            'Tipo' => $servicio->Tipo
                        ];

                        return response()->json($mensaje, 200);
                    } catch (\Throwable $th) {
                        abort(code: 409, message: "El servicio '{$request->Nombre}' ya se encuentra registrado");
                    }
                }else{
                    abort(code: 404, message: "No se encontro el servidor con ID: {$request->IdServidor}");
                }
            } else {
                abort(code: 404, message: "No se encontro el servicio con ID: {$request->IdServicio}");
            }
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
        $servidor = Servicio::destroy($request->IdServicio);

        if ($servidor) {
            $mensaje = [
                'Respuesta del Servidor' => "Se elimino el servicio con ID: {$request->IdServicio}"
            ];

            return response()->json($mensaje, 200);
        } else {
            abort(code: 404, message: "No se encontro el servicio con ID: {$request->IdServicio}");
        }
    }
}
