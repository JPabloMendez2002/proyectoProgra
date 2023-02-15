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
        Schema::create('Encargo_Servidor', function (Blueprint $table) {
            $table->unsignedBigInteger('IdEncargado');
            $table->unsignedBigInteger('IdServidor');
            $table->boolean('Alertas');
            $table->timestamps();

            $table->foreign('IdEncargado')->references('IdUsuario')->on('Usuarios');
            $table->foreign('IdServidor')->references('IdServidor')->on('Servidores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Encargo_Servidor');
    }
};
