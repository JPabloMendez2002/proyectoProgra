<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlertasServidor;

class Alertas_ServidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alerta1 = new AlertasServidor();
        $alerta1->IdServidor = 1;
        $alerta1->Monitoreo = 1;
        $alerta1->save();

        $alerta2 = new AlertasServidor();
        $alerta2->IdServidor = 2;
        $alerta2->Monitoreo = 1;
        $alerta2->save();

        $alerta3 = new AlertasServidor();
        $alerta3->IdServidor = 3;
        $alerta3->Monitoreo = 1;
        $alerta3->save();
    }
}
