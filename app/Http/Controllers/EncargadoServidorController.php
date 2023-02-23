<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EncargadoServidor;
use App\Models\Servidor;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EncargadoServidorController extends Controller
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
        $encargado = new EncargadoServidor();
        $reglas = [
            'IdEncargado' => 'required|integer',
            'IdServidor' => 'required|integer',
            'Alertas' => 'required|boolean',
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $errores =  implode(" ", $validator->errors()->all());

            abort(code: 400, message: "Error de validacion: {$errores}");
        } else {

            $usuario = Usuario::find($request->IdEncargado);
            if (!empty($usuario)) {
                $sevidor = Servidor::find($request->IdServidor);

                if (!empty($sevidor)) {
                    $mismoservidor = EncargadoServidor::WHERE('IdServidor', "=", $request->IdServidor)
                        ->WHERE('IdEncargado', "=", $request->IdEncargado)
                        ->exists();

                    if (!empty($mismoservidor)) {
                        abort(code: 409, message: "El usuario con ID: {$request->IdEncargado} ya se encuentra a cargo del servidor con ID: {$request->IdServidor}");
                    } else {

                        $encargado->IdEncargado = $request->IdEncargado;
                        $encargado->IdServidor = $request->IdServidor;
                        $encargado->Alertas = $request->Alertas;

                        $encargado->save();

                        $mensaje = [
                            'Respuesta del Servidor' => "Encargado de servidor agregado correctamente",
                        ];

                        return response()->json($mensaje, 201);
                    }
                } else {
                    abort(code: 404, message: "No se encontro el servidor con ID: {$request->IdServidor}");
                }
            } else {
                abort(code: 404, message: "No se encontro el usuario con ID: {$request->IdEncargado}");
            }
        }
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
    public function update(Request $request, $id)
    {
        //
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
