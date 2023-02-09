<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Intervalo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class IntervaloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $intervalos = Intervalo::all();
        $datos = [];
 
        foreach ($intervalos as $intervalo) {
            $datos[] = [
                'ID' => $intervalo->IdIntervalo,
                'Nombre' => $intervalo->Nombre,
                'Descripcion' => $intervalo->Descripcion
            ];
        }
     
        if(!empty($intervalo)){
            return response()->json($datos);
        }else{

            $mensaje = [
                'Mensaje' => "No hay datos por mostrar",
            ];
            return response()->json($mensaje);
        }

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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

            $intervalo = new Intervalo();
            $reglas = [
                'Nombre'=>'required|string',
                'Descripcion'=>'required|string',
            ];

            $validator = Validator::make($request->all(), $reglas);
            if($validator->fails()){
                $mensaje = [
                    'Respuesta del Servidor' => "Error 404 Not Found",
                    'Mensaje' => "No pueden existir campos vacíos",
                    'Error' => $validator->errors()->all()
                ];
                return response()->json($mensaje);
            }else{
                $intervalo->Nombre = $request->Nombre;
                $intervalo->Descripcion = $request->Descripcion;
                $intervalo->save();
                $mensaje = [
                    'Respuesta del Servidor' => "201 Created",
                    'Mensaje' => "Intervalo agregado correctamente",
                    'Datos' => $intervalo
                ];
                return response()->json($mensaje);
            }

        } catch (\Throwable $th) {
            $mensaje = [
                'Respuesta del Servidor' => "Error 409 Conflict",
                'Mensaje' => "El intervalo '{$request->Nombre}' ya se encuentra registrado"
            ];

            return response()->json($mensaje);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $intervalo = Intervalo::find($request->IdIntervalo);

        if (!empty($intervalo)) {

            $mensaje = [
                'Respuesta del Servidor' => "200 OK",
                'ID' => $intervalo->IdIntervalo,
                'Nombre' => $intervalo->Nombre,
                'Descripcion' => $intervalo->Descripcion
            ];
            return response()->json($mensaje);
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el intervalo con ID: {$request->IdIntervalo}"
            ];
            return response()->json($mensaje);
        }
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

        try {

            $intervalo = Intervalo::find($request->IdIntervalo);
            $reglas = [
                'Nombre'=>'required|string',
                'Descripcion'=>'required|string',
            ];

            $validator = Validator::make($request->all(), $reglas);
            if ($validator->fails()) {
                $mensaje = [
                    'Respuesta del Servidor' => "Error 404 Not Found",
                    'Mensaje' => "No pueden existir campos vacíos",
                    'Error' => $validator->errors()->all()
                ];
                return response()->json($mensaje);
            }else{
                $intervalo->Nombre = $request->Nombre;
                $intervalo->Descripcion = $request->Descripcion;
                $intervalo->save();

                $mensaje = [
                    'Respuesta del Servidor' => "200 OK",
                    'Mensaje' => "Se actualizaron los datos correctamente",
                    'ID' => $intervalo->IdIntervalo,
                    'Nombre' => $intervalo->Nombre,
                    'Descripcion' => $intervalo->Descripcion
                ];

                return response()->json($mensaje);
            }

        } catch (\Throwable $th) {
                $mensaje = [
                    'Respuesta del Servidor' => "Error 404 Not Found",
                    'Mensaje' => "No se encontro el intervalo con ID: {$request->IdIntervalo}"
                ];
            return response()->json($mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $intervalo = Intervalo::destroy($request->IdIntervalo);

        if ($intervalo) {
            $mensaje = [
                'Respuesta del Servidor' => "200 OK",
                'Mensaje' => "Se elimino el intervalo con ID: {$request->IdIntervalo}"
            ];

            return response()->json($mensaje);
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404 Not Found",
                'Mensaje' => "No se encontro el intervalo con ID: {$request->IdIntervalo}"
            ];

            return response()->json($mensaje);
        }
    }
}
