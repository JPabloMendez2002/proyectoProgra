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
        $servidor1->Nombre = "Servidor1";
        $servidor1->Descripcion = "Servidor1";
        $servidor1->UsuarioAdministrador = "Dan";
        $servidor1->Contrasena = Hash::make("123");
        $servidor1->save();

        $servidor2 = new Servidor();
        $servidor2->Nombre = "Servidor2";
        $servidor2->Descripcion = "Servidor2";
        $servidor2->UsuarioAdministrador = "Maria";
        $servidor2->Contrasena = Hash::make("123");
        $servidor2->save();

        $servidor3 = new Servidor();
        $servidor3->Nombre = "Servidor3";
        $servidor3->Descripcion = "Servidor3";
        $servidor3->UsuarioAdministrador = "Pedro";
        $servidor3->Contrasena = Hash::make("123");
        $servidor3->save();
    }
}
