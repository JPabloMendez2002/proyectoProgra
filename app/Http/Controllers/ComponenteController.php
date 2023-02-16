<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Componente;
use Illuminate\Support\Facades\Validator;

class ComponenteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $componente = new Componente();

        $reglas = [
            'Nombre' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $errores =  implode(" ", $validator->errors()->all());

            abort(code: 400, message: "Error de validacion: {$errores}");
        } else {
            try {
                $componente->Nombre = $request->Nombre;
                $componente->save();

                $mensaje = [
                    'Respuesta del Servidor' => "Componente agregado correctamente",
                    'Datos creados' => $componente
                ];

                return response()->json($mensaje, 201);
            } catch (\Throwable $th) {
                abort(code: 409, message: "El componente '{$request->Nombre}' ya se encuentra registrado");
            }
        }
    }
}
