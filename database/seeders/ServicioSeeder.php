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
        $servicio1->Nombre = "Servicio1";
        $servicio1->Descripcion = "Servicio1";
        $servicio1->TimeoutRespuesta = 2;
        $servicio1->Tipo = "Socket";
        $servicio1->save();

        $servicio2 = new Servicio();
        $servicio2->IdServidor = 1;
        $servicio2->Nombre = "Servicio2";
        $servicio2->Descripcion = "Servicio2";
        $servicio2->TimeoutRespuesta = 3;
        $servicio2->Tipo = "Web";
        $servicio2->save();

        $servicio3 = new Servicio();
        $servicio3->IdServidor = 2;
        $servicio3->Nombre = "Servicio3";
        $servicio3->Descripcion = "Servicio3";
        $servicio3->TimeoutRespuesta = 5;
        $servicio3->Tipo = "Socket";
        $servicio3->save();

        $servicio4 = new Servicio();
        $servicio4->IdServidor = 2;
        $servicio4->Nombre = "Servicio4";
        $servicio4->Descripcion = "Servicio4";
        $servicio4->TimeoutRespuesta = 6;
        $servicio4->Tipo = "Web";
        $servicio4->save();

        $servicio5 = new Servicio();
        $servicio5->IdServidor = 3;
        $servicio5->Nombre = "Servicio5";
        $servicio5->Descripcion = "Servicio5";
        $servicio5->TimeoutRespuesta = 5;
        $servicio5->Tipo = "Web";
        $servicio5->save();

        $servicio6 = new Servicio();
        $servicio6->IdServidor = 3;
        $servicio6->Nombre = "Servicio6";
        $servicio6->Descripcion = "Servicio6";
        $servicio6->TimeoutRespuesta = 2;
        $servicio6->Tipo = "Socket";
        $servicio6->save();
    }
}
