<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuarioSeeder::class);
        $this->call(ServidorSeeder::class);
        $this->call(UmbralSeeder::class);
        $this->call(ComponenteSeeder::class);
        $this->call(Encargado_ServidorSeeder::class);
        $this->call(ServicioSeeder::class);
        $this->call(Encargado_ServicioSeeder::class);
    }
}
