<?php

namespace App\Http\Controllers;

use App\Models\ParametroServidor;
use App\Models\Servidor;
use App\Models\Umbral;
use App\Models\Componente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParametroServidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parametros = ParametroServidor::all();
        $datos = [];

        foreach ($parametros as $parametro) {
            $datos[] = [
                'ID Servidor' => $parametro->IdServidor,
                'ID Componente' => $parametro->IdComponente,
                'ID Umbral' => $parametro->IdUmbral,
                'Porcentaje' => $parametro->Porcentaje
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
        $parametro = new ParametroServidor();

        $reglas = [
            'IdServidor' => 'required|integer',
            'IdComponente' => 'required|integer',
            'IdUmbral' => 'required|integer',
            'Porcentaje' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $errores =  implode(" ", $validator->errors()->all());

            abort(code: 400, message: "No pueden existir campos vacíos: {$errores}");
        } else {

            $sevidor = Servidor::find($request->IdServidor);

            if (!empty($sevidor)) {
                $componente = Componente::find($request->IdComponente);

                if (!empty($componente)) {
                    $umbral = Umbral::find($request->IdUmbral);

                    if (!empty($umbral)) {
                        $parametro->IdServidor = $request->IdServidor;
                        $parametro->IdComponente = $request->IdComponente;
                        $parametro->IdUmbral = $request->IdUmbral;
                        $parametro->Porcentaje = $request->Porcentaje;
                        $parametro->save();

                        $mensaje = [
                            'Respuesta del Servidor' => "Parametro agregado correctamente",
                            'Datos creados' => $parametro
                        ];

                        return response()->json($mensaje, 201);
                    } else {
                        abort(code: 404, message: "No se encontro el umbral con ID: {$request->IdUmbral}");
                    }
                } else {
                    abort(code: 404, message: "No se encontro el componente con ID: {$request->IdComponente}");
                }
            } else {
                abort(code: 404, message: "No se encontro el servidor con ID: {$request->IdServidor}");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParametrosServidor  $parametrosServidor
     * @return \Illuminate\Http\Response
     */
    public function show(ParametroServidor $parametrosServidor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParametrosServidor  $parametrosServidor
     * @return \Illuminate\Http\Response
     */
    public function edit(ParametroServidor $parametrosServidor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParametrosServidor  $parametrosServidor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $parametro = ParametroServidor::find($request->IdParametro);

        if (!empty($parametro)) {

            $reglas = [
                'IdServidor' => 'required|integer',
                'IdComponente' => 'required|integer',
                'IdUmbral' => 'required|integer',
                'Porcentaje' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $reglas);

            if ($validator->fails()) {
                $errores =  implode(" ", $validator->errors()->all());

                abort(code: 400, message: "No pueden existir campos vacíos: {$errores}");
            } else {
                $parametro->IdServidor = $request->IdServidor;
                $parametro->IdComponente = $request->IdComponente;
                $parametro->IdUmbral = $request->IdUmbral;
                $parametro->Porcentaje = $request->Porcentaje;
                $parametro->save();

                $mensaje = [
                    'ID Servidor' => $parametro->IdServidor,
                    'ID Componente' => $parametro->IdComponente,
                    'ID Umbral' => $parametro->IdUmbral,
                    'Porcentaje' => $parametro->Porcentaje
                ];

                return response()->json($mensaje, 200);
            }
        } else {
            abort(code: 404, message: "No se encontro el parametro con ID: {$request->IdParametro}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParametrosServidor  $parametrosServidor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $parametro = ParametroServidor::destroy($request->IdParametro);

        if ($parametro) {
            $mensaje = [
                'Respuesta del Servidor' => "Se elimino el parametro con ID: {$request->IdParametro}"
            ];

            return response()->json($mensaje, 200);
        } else {
            abort(code: 404, message: "No se encontro el parametro con ID: {$request->IdParametro}");
        }
    }
}
