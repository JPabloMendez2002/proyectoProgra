<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Componente;

class ComponenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $componente1 = new Componente();
        $componente1->Nombre = 'CPU';
        $componente1->save();

        $componente2 = new Componente();
        $componente2->Nombre = 'RAM';
        $componente2->save();

        $componente3 = new Componente();
        $componente3->Nombre = 'Disco';
        $componente3->save();
    }
}
