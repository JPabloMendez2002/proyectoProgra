<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function login(Request $request)
    {

        $reglas = [
            'Usuario' => 'required|string',
            'Contrasena' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $mensaje = [
                'Mensaje' => "No pueden existir campos vacíos",
                'Error' => $validator->errors()->all()
            ];

            return response()->json($mensaje);
        } else {
            $usuario = Usuario::where('Nombre', $request->Usuario)->first();

            if ($usuario) {
                if (sha1($request->Contrasena) == $usuario->Contrasena) {
                    $mensaje = [
                        'Respuesta del Servidor' => '200 OK',
                        'Mensaje' => "Bienvenido al sistema {$usuario->Nombre}"
                    ];

                    return response()->json($mensaje);
                } else {
                    $mensaje = [
                        'Mensaje' => "Contraseña Incorrecta"
                    ];

                    return response()->json($mensaje);
                }
            } else {
                abort(code:404,message:"No existe este usuario");
            }
        }
    }
}
