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
        Schema::create('Servidores', function (Blueprint $table) {
            $table->id('IdServidor');
            $table->string('Nombre',20);
            $table->text('Descripcion');
            $table->string('UsuarioAdministrador',20);
            $table->string('Contrasena',100);
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
        Schema::dropIfExists('Servidores');
    }
};
