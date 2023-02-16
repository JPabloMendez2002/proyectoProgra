<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Reset AutoIncrement SQL: DBCC CHECKIDENT('table', RESEED, 0)
     * @return void
     */
    public function up()
    {
        Schema::create('Usuarios', function (Blueprint $table) {
            $table->id('IdUsuario');
            $table->string('Nombre',20)->unique();
            $table->string('Contrasena',100);
            $table->string('NombreCompleto',50);
            $table->string('Correo',30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Usuarios');
    }
};
