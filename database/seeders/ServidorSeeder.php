<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servidor;
use Illuminate\Support\Facades\Hash;

class ServidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servidor1 = new Servidor();
        $servidor1->Nombre = "Servidor Windows";
        $servidor1->Descripcion = "Almacena bases de datos";
        $servidor1->UsuarioAdministrador = "Dan";
        $servidor1->Contrasena = Hash::make("123");
        $servidor1->save();

        $servidor2 = new Servidor();
        $servidor2->Nombre = "Servidor Linux";
        $servidor2->Descripcion = "Almacena aplicaciones web";
        $servidor2->UsuarioAdministrador = "Maria";
        $servidor2->Contrasena = Hash::make("123");
        $servidor2->save();

        $servidor3 = new Servidor();
        $servidor3->Nombre = "Servidor Extra";
        $servidor3->Descripcion = "Servidor Extra";
        $servidor3->UsuarioAdministrador = "Pedro";
        $servidor3->Contrasena = Hash::make("123");
        $servidor3->save();
    }
}
