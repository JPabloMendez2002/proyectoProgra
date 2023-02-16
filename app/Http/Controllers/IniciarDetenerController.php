<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IniciarDetenerServicio;
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
        
        // if(!empty($encargado)){
        //     $verifica = IniciarDetenerServicio::find($request->Alertas);
        // }


        // $verifica = IniciarDetenerServicio::WHERE("IdEncargado", "=", $request->IdEncargado)
        //  ->SELECT("Alertas")->get();

        // echo $verifica;
        // if($verifica->Alertas == $request->Alertas){
        //     abort(code: 409, message: "La alerta ya se encuentra en estado '{$request->Alertas}'");
        // }
        $estadoactual = IniciarDetenerServicio::WHERE('IdEncargado', "=", $request->IdEncargado)
        ->SELECT('Alertas');

        // if ($encargado->Alertas == 1) {
        //     abort(code: 409, message: "La alerta ya se encuentra en estado '{$encargado->Alertas}'");
        // } else {
            echo $estadoactual;

            if (!empty($encargado)) {

                $reglas = [
                    'Alertas' => 'required|boolean'
                ];

                $validator = Validator::make($request->all(), $reglas);

                if ($validator->fails()) {
                    $errores =  implode(" ", $validator->errors()->all());

                    abort(code: 400, message: "No pueden existir campos vacíos: {$errores}");
                } else {
                        $encargado->Alertas = $request->Alertas;
                        $encargado->save();

                        $mensaje = [
                            'Respuesta del Servidor' => "Se actualizaron los datos correctamente",
                            'Alertas' => $encargado->Alertas,
                        ];

                        return response()->json($mensaje, 200);     
                }
            } else {
                abort(code: 404, message: "No se encontro el un encargado de servicio con ID: {$request->IdEncargado}");
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
