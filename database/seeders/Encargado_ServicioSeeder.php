<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EncargadoServicio;

class Encargado_ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $encargado1 = new EncargadoServicio();
        $encargado1->IdEncargado = 1;
        $encargado1->IdServicio = 1;
        $encargado1->Alertas = 0;
        $encargado1->save();

        $encargado2 = new EncargadoServicio();
        $encargado2->IdEncargado = 1;
        $encargado2->IdServicio = 2;
        $encargado2->Alertas = 1;
        $encargado2->save();

        $encargado3 = new EncargadoServicio();
        $encargado3->IdEncargado = 2;
        $encargado3->IdServicio = 3;
        $encargado3->Alertas = 0;
        $encargado3->save();

        $encargado4 = new EncargadoServicio();
        $encargado4->IdEncargado = 2;
        $encargado4->IdServicio = 4;
        $encargado4->Alertas = 1;
        $encargado4->save();

        $encargado5 = new EncargadoServicio();
        $encargado5->IdEncargado = 3;
        $encargado5->IdServicio = 5;
        $encargado5->Alertas = 0;
        $encargado5->save();

        $encargado6 = new EncargadoServicio();
        $encargado6->IdEncargado = 1;
        $encargado6->IdServicio = 6;
        $encargado6->Alertas = 1;
        $encargado6->save();
    }
}
