<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Umbral;

class UmbralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $umbral1 = new Umbral();
        $umbral1->Nombre = 'Normal';
        $umbral1->save();

        $umbral2 = new Umbral();
        $umbral2->Nombre = 'Advertencia';
        $umbral2->save();

        $umbral3 = new Umbral();
        $umbral3->Nombre = 'Error';
        $umbral3->save();
    }
}
