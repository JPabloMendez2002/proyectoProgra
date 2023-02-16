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
                'Usuario Administrador' => $servidor->UsuarioAdministrador,
                'Contrasena' => $servidor->Contrasena
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
        try {
            $servidor = new Servidor();

            $reglas = [
                'Nombre' => 'required|string',
                'Descripcion' => 'required|string',
                'UsuarioAdministrador' => 'required|string',
                'Contrasena' => 'required|string'
            ];

            $validator = Validator::make($request->all(), $reglas);

            if ($validator->fails()) {
                $errores =  implode(" ", $validator->errors()->all());

                abort(code: 400, message: "No pueden existir campos vacíos: {$errores}");
            } else {
                $servidor->Nombre = $request->Nombre;
                $servidor->Descripcion = $request->Descripcion;
                $servidor->UsuarioAdministrador = $request->UsuarioAdministrador;
                $servidor->Contrasena = sha1($request->Contrasena);
                $servidor->save();

                $mensaje = [
                    'Respuesta del Servidor' => "Servidor agregado correctamente",
                    'Datos creados' => $servidor
                ];

                return response()->json($mensaje, 201);
            }
        } catch (\Throwable $th) {
            abort(code: 409, message: "El servidor '{$request->Nombre}' ya se encuentra registrado");
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
        $servidor = Servidor::where('Nombre', $request->IdServidor)->first();

        if (!empty($servidor)) {
            $mensaje = [
                'ID' => $servidor->IdServidor,
                'Nombre' => $servidor->Nombre,
                'Descripcion' => $servidor->Descripcion,
                'Usuario Administrador' => $servidor->UsuarioAdministrador,
                'Contrasena' => $servidor->Contrasena
            ];

            return response()->json($mensaje, 200);
        } else {
            abort(code: 404, message: "No se encontro el servidor con Nombre: {$request->IdServidor}");
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
        $servidor = Servidor::find($request->IdServidor);

        if (!empty($servidor)) {

            try {
                $reglas = [
                    'Nombre' => 'required|string',
                    'Descripcion' => 'required|string',
                    'UsuarioAdministrador' => 'required|string',
                    'Contrasena' => 'required|string'
                ];

                $validator = Validator::make($request->all(), $reglas);

                if ($validator->fails()) {
                    $errores =  implode(" ", $validator->errors()->all());

                    abort(code: 400, message: "No pueden existir campos vacíos: {$errores}");
                } else {
                    $servidor->Nombre = $request->Nombre;
                    $servidor->Descripcion = $request->Descripcion;
                    $servidor->UsuarioAdministrador = $request->UsuarioAdministrador;
                    $servidor->Contrasena = sha1($request->Contrasena);
                    $servidor->save();

                    $mensaje = [
                        'Respuesta del Servidor' => "Se actualizaron los datos correctamente",
                        'ID' => $servidor->IdServidor,
                        'Nombre' => $servidor->Nombre,
                        'Descripcion' => $servidor->Descripcion,
                        'Usuario Administrador' => $servidor->UsuarioAdministrador,
                        'Contrasena' => $servidor->Contrasena
                    ];

                    return response()->json($mensaje, 200);
                }
            } catch (\Throwable $th) {
                abort(code: 409, message: "El servidor '{$request->Nombre}' ya se encuentra registrado");
            }
        } else {
            abort(code: 404, message: "No se encontro el servidor con ID: {$request->IdServidor}");
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
                'Respuesta del Servidor' => "Se elimino el servidor con ID: {$request->IdServidor}"
            ];

            return response()->json($mensaje, 200);
        } else {
            abort(code: 404, message: "No se encontro el servidor con ID: {$request->IdServidor}");
        }
    }
}
