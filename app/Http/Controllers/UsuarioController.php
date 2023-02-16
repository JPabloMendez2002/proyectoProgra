<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $usuario = new Usuario();

            $reglas = [
                'Usuario' => 'required|string',
                'Contrasena' => 'required|string',
                'NombreCompleto' => 'required|string',
                'Correo' => 'required|email'
            ];

            $validator = Validator::make($request->all(), $reglas);

            if ($validator->fails()) {
                $errores =  implode(" ", $validator->errors()->all());

                abort(code: 400, message: "Error de validacion: {$errores}");
            } else {
                $usuario->Nombre = $request->Usuario;
                $usuario->Contrasena = sha1($request->Contrasena);
                $usuario->NombreCompleto = $request->NombreCompleto;
                $usuario->Correo = $request->Correo;
                $usuario->save();

                $mensaje = [
                    'Respuesta del Servidor' => "Usuario agregado correctamente",
                    'Datos creados' => $usuario
                ];

                return response()->json($mensaje, 201);
            }
        } catch (\Throwable $th) {
            abort(code: 409, message: "El usuario '{$request->Nombre}' ya se encuentra registrado");
        }
    }

    /**
     * Validate Users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $reglas = [
            'Usuario' => 'required|string',
            'Contrasena' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $errores =  implode(" ", $validator->errors()->all());

            abort(code: 400, message: "No pueden existir campos vacíos: {$errores}");
        } else {
            $usuario = Usuario::where('Nombre', $request->Usuario)->first();

            if ($usuario) {
                if (sha1($request->Contrasena) == $usuario->Contrasena) {
                    $mensaje = [
                        'Respuesta del Servidor' => "Bienvenido al sistema {$usuario->Nombre}"
                    ];

                    return response()->json($mensaje);
                } else {
                    $mensaje = [
                        'Respuesta del Servidor' => "Contraseña Incorrecta"
                    ];

                    return response()->json($mensaje, 200);
                }
            } else {
                abort(code: 404, message: "No existe este usuario");
            }
        }
    }
}
