<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $usuario = new Usuario();
        $usuario->Nombre = 'Felipe';
        $usuario->Contrasena = sha1("123");
        $usuario->NombreCompleto = 'Felipe Houdson Robles';
        $usuario->Correo = 'Felipe@mail.com';
        $usuario->TipoUsuario = 1;
        $usuario->save();

        $usuario1 = new Usuario();
        $usuario1->Nombre = 'Dan';
        $usuario1->Contrasena = sha1("123");
        $usuario1->NombreCompleto = 'Dan Perez Gomez';
        $usuario1->Correo = 'Dan@mail.com';
        $usuario1->TipoUsuario = 0;
        $usuario1->save();

        $usuario2 = new Usuario();
        $usuario2->Nombre = 'Maria';
        $usuario2->Contrasena = sha1("123");
        $usuario2->NombreCompleto = 'Maria Zuñiga Guzman';
        $usuario2->Correo = 'Maria@mail.com';
        $usuario2->TipoUsuario = 0;
        $usuario2->save();

        $usuario3 = new Usuario();
        $usuario3->Nombre = 'Pedro';
        $usuario3->Contrasena = sha1("123");
        $usuario3->NombreCompleto = 'Pedro Segura Montoya';
        $usuario3->Correo = 'Pedro@mail.com';
        $usuario3->TipoUsuario = 0;
        $usuario3->save();
    }
}
