<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umbral;
use Illuminate\Support\Facades\Validator;

class UmbralController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $umbral = new Umbral();

        $reglas = [
            'Nombre' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $errores =  implode(" ", $validator->errors()->all());

            abort(code: 400, message: "Error de validacion: {$errores}");
        } else {
            try {
                $umbral->Nombre = $request->Nombre;
                $umbral->save();

                $mensaje = [
                    'Respuesta del Servidor' => "Umbral agregado correctamente",
                    'Datos creados' => $umbral
                ];

                return response()->json($mensaje, 201);
            } catch (\Throwable $th) {
                abort(code: 409, message: "El umbral '{$request->Nombre}' ya se encuentra registrado");
            }
        }
    }
}
