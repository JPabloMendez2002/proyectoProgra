<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Usuarios', function (Blueprint $table) {
            $table->id('IdUsuario');
            $table->string('Nombre',20);
            $table->string('Usuario',20);
            $table->string('Contrasena',100);
            $table->string('Correo',30);
            $table->unsignedBigInteger('IdRol');

            $table->foreign('IdRol')->references('IdRol')->on('Roles');

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
