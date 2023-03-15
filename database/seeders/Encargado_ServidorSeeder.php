<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EncargadoServidor;

class Encargado_ServidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $encargado1 = new EncargadoServidor();
        $encargado1->IdEncargado = 1;
        $encargado1->IdServidor = 1;
        $encargado1->Alertas = 0;
        $encargado1->save();

        $encargado2 = new EncargadoServidor();
        $encargado2->IdEncargado = 2;
        $encargado2->IdServidor = 2;
        $encargado2->Alertas = 1;
        $encargado2->save();

        $encargado3 = new EncargadoServidor();
        $encargado3->IdEncargado = 3;
        $encargado3->IdServidor = 3;
        $encargado3->Alertas = 1;
        $encargado3->save();
    }
}
