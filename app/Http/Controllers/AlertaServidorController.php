<?php

namespace App\Http\Controllers;

use App\Models\AlertasServidor;
use App\Models\Servidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlertaServidorController extends Controller
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
    public function update(Request $request)
    {
        $reglas = [
            'Monitoreo' => 'required|boolean'
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $errores =  implode(" ", $validator->errors()->all());

            abort(code: 400, message: "Error de validaciones: {$errores}");
        }else{
            $servidor = Servidor::find($request->IdServidor);

            if(!empty($servidor)){
                $alertas = AlertasServidor::find($request->IdServidor);

                $alertas->Monitoreo = $request->Monitoreo;
                $alertas->save();

                $mensaje = [
                    'Respuesta del Servidor' => "Se actualizaron los datos correctamente"
                ];

                return response()->json($mensaje, 200);
            }else{
                abort(code: 404, message: "No se encontro un servidor con ID: {$request->IdServidor}");
            }
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
