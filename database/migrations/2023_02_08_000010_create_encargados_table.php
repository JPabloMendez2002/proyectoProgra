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
        Schema::create('Encargados', function (Blueprint $table) {
            $table->unsignedBigInteger('IdEncargado');
            $table->unsignedBigInteger('IdServidor');
            $table->unsignedBigInteger('IdServicio');

            $table->foreign('IdEncargado')->references('IdUsuario')->on('Usuarios');
            $table->foreign('IdServidor')->references('IdServidor')->on('Servidores');
            $table->foreign('IdServicio')->references('IdServicio')->on('Servicios');

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
        Schema::dropIfExists('Encargados');
    }
};
