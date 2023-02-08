<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::all();

        $datos = [];
        foreach ($roles as $rol) {
            $datos[] = [
                'ID' => $rol->IdRol,
                'Descripcion' => $rol->Descripcion
            ];
        }

        return response()->json($roles);
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
        $rol = new Rol();
        $rol->Descripcion = $request->Descripcion;
        $rol->save();

        $mensaje = [
            'Respuesta del Servidor' => "201 Created",
            'Mensaje' => "Rol agregado correctamente {$rol}"
        ];

        return response()->json($mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $rol = Rol::find($request->IdRol);

        if (!empty($rol)) {
            return response()->json($rol);
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404",
                'Mensaje' => "No se encontro el rol con ID: {$request->IdRol}"
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

        $rol = Rol::find($request->IdRol);

        if (!empty($rol)) {
            if($request->Descripcion!=""){
                $rol->descripcion = $request->Descripcion;
                $rol->save();

                $mensaje = [
                    'Respuesta del Servidor' => "200 OK",
                    'Mensaje' => "Se actualizaron los datos correctamente",
                    'ID' => $rol->IdRol,
                    'Descripcion' => $rol->descripcion
                ];

                return response()->json($mensaje);
            }else{
                $mensaje = [
                    'Respuesta del Servidor' => "Error",
                    'Mensaje' => "No se permiten descripciones vacias"
                ];

                return response()->json($mensaje);
            }

        } else {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404",
                'Mensaje' => "No se encontro el rol con ID: {$request->IdRol}"
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

        $rol = Rol::destroy($request->IdRol);

        if ($rol) {
            $mensaje = [
                'Respuesta del Servidor' => "200 OK",
                'Mensaje' => "Se elimino el rol con ID: {$request->IdRol}"
            ];

            return response()->json($mensaje);
        } else {
            $mensaje = [
                'Respuesta del Servidor' => "Error 404",
                'Mensaje' => "No se encontro el rol con ID: {$request->IdRol}"
            ];

            return response()->json($mensaje);
        }
    }
}
