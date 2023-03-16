<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicio1 = new Servicio();
        $servicio1->IdServidor = 1;
        $servicio1->Nombre = "Base de datos 1";
        $servicio1->Descripcion = "Base de datos 1";
        $servicio1->TimeoutRespuesta = 5;
        $servicio1->Tipo = "Socket";
        $servicio1->save();

        $servicio2 = new Servicio();
        $servicio2->IdServidor = 1;
        $servicio2->Nombre = "Base de datos 2";
        $servicio2->Descripcion = "Base de datos 2";
        $servicio2->TimeoutRespuesta = 5;
        $servicio2->Tipo = "Socket";
        $servicio2->save();

        $servicio3 = new Servicio();
        $servicio3->IdServidor = 2;
        $servicio3->Nombre = "Aplicacion web 1";
        $servicio3->Descripcion = "Aplicacion web 1";
        $servicio3->TimeoutRespuesta = 7;
        $servicio3->Tipo = "Web";
        $servicio3->save();

        $servicio4 = new Servicio();
        $servicio4->IdServidor = 2;
        $servicio4->Nombre = "Aplicacion web 2";
        $servicio4->Descripcion = "Aplicacion web 2";
        $servicio4->TimeoutRespuesta = 7;
        $servicio4->Tipo = "Web";
        $servicio4->save();

        $servicio5 = new Servicio();
        $servicio5->IdServidor = 3;
        $servicio5->Nombre = "Servicio Extra 1";
        $servicio5->Descripcion = "Servicio extra 1";
        $servicio5->TimeoutRespuesta = 8;
        $servicio5->Tipo = "Web";
        $servicio5->save();

        $servicio6 = new Servicio();
        $servicio6->IdServidor = 3;
        $servicio6->Nombre = "Servicio Extra 2";
        $servicio6->Descripcion = "Servicio extra 2";
        $servicio6->TimeoutRespuesta = 5;
        $servicio6->Tipo = "Socket";
        $servicio6->save();
    }
}
