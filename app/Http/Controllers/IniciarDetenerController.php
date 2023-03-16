<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IniciarDetenerServicio;
use App\Models\IniciarDetenerServidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IniciarDetenerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAlertaServicio(Request $request, $id)
    {
        $encargado = IniciarDetenerServicio::find($request->IdEncargado);
        $estadoactual = IniciarDetenerServicio::WHERE('Alertas', "=", $request->Alertas)
            ->WHERE('IdEncargado', "=", $request->IdEncargado)
            ->exists();

        if (!empty($encargado)) {
            $reglas = [
                'Alertas' => 'required|boolean'
            ];

            $validator = Validator::make($request->all(), $reglas);

            if ($validator->fails()) {
                $errores =  implode(" ", $validator->errors()->all());

                abort(code: 400, message: "No pueden existir campos vacíos: {$errores}");
            } else {
                if ($encargado->Alertas = $estadoactual) {
                    abort(code: 409, message: "La alerta ya se encuentra en estado '{$request->Alertas}'");
                } else {
                    $encargado->Alertas = $request->Alertas;
                    $encargado->save();

                    $mensaje = [
                        'Respuesta del Servidor' => "Se actualizaron los datos correctamente",
                        'Alertas' => $encargado->Alertas,
                    ];

                    return response()->json($mensaje, 200);
                }
            }
        } else {
            abort(code: 404, message: "No se encontro un encargado de servicio con ID: {$request->IdEncargado}");
        }
    }

    public function updateAlertaServidor(Request $request, $id)
    {
        $encargado = IniciarDetenerServidor::find($request->IdEncargado);
        $estadoactual = IniciarDetenerServidor::WHERE('Alertas', "=", $request->Alertas)
            ->WHERE('IdEncargado', "=", $request->IdEncargado)
            ->exists();

        if (!empty($encargado)) {
            $reglas = [
                'Alertas' => 'required|boolean'
            ];

            $validator = Validator::make($request->all(), $reglas);

            if ($validator->fails()) {
                $errores =  implode(" ", $validator->errors()->all());

                abort(code: 400, message: "No pueden existir campos vacíos: {$errores}");
            } else {
                if ($encargado->Alertas = $estadoactual) {
                    abort(code: 409, message: "La alerta ya se encuentra en estado '{$request->Alertas}'");
                } else {
                    $encargado->Alertas = $request->Alertas;
                    $encargado->save();

                    $mensaje = [
                        'Respuesta del Servidor' => "Se actualizaron los datos correctamente",
                        'Alertas' => $encargado->Alertas,
                    ];

                    return response()->json($mensaje, 200);
                }
            }
        } else {
            abort(code: 404, message: "No se encontro un encargado de servidor con ID: {$request->IdEncargado}");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
