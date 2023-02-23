<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EncargadoServicio;
use App\Models\Servicio;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\NotIn;

class EncargadoServicioController extends Controller
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


        // $encargadoactual = EncargadoServicio::find($request->IdEncargado);
        // $mismoservicio = EncargadoServicio::WHERE('IdServicio', "=", $request->IdServicio)
        // ->WHERE('IdEncargado', "=", $request->IdEncargado)
        // ->exists();

        $encargado = new EncargadoServicio();
        $reglas = [
            'IdEncargado' => 'required|integer',
            'IdServicio' => 'required|integer',
            'Alertas' => 'required|boolean',
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $errores =  implode(" ", $validator->errors()->all());

            abort(code: 400, message: "Error de validacion: {$errores}");
        } else {

            $usuario = Usuario::find($request->IdEncargado);
            if (!empty($usuario)) {
                $sevidor = Servicio::find($request->IdServicio);
                if (!empty($sevidor)) {
                    $mismoservicio = EncargadoServicio::WHERE('IdServicio', "=", $request->IdServicio)
                    ->WHERE('IdEncargado', "=", $request->IdEncargado)
                    ->exists();
                    if (!empty($mismoservicio)) {
                        abort(code: 409, message: "El usuario con ID: {$request->IdEncargado} ya se encuentra a cargo del servivio con ID: {$request->IdServicio}");
                    }else{

                        $encargado->IdEncargado = $request->IdEncargado;
                        $encargado->IdServicio = $request->IdServicio;
                        $encargado->Alertas = $request->Alertas;

                        $encargado->save();

                        $mensaje = [
                            'Respuesta del Servidor' => "Encargado de servicio agregado correctamente",
                        ];
                    
                        return response()->json($mensaje, 201);
                    }

                } else {
                    abort(code: 404, message: "No se encontro el servicio con ID: {$request->IdServicio}");
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
