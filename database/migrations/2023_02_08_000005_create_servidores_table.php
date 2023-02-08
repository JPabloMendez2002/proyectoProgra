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
            $table->string('Contrasena',100);
            $table->unsignedBigInteger('IdParametroServidor');
            $table->integer('Notificaciones');

            $table->foreign('IdParametroServidor')->references('IdParametroServidor')->on('Parametros_Servidores');

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
