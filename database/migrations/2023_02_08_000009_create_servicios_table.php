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
        Schema::create('Servicios', function (Blueprint $table) {
            $table->id('IdServicio');
            $table->unsignedBigInteger('IdServidor');
            $table->string('Nombre',20)->unique();
            $table->text('Descripcion');
            $table->integer('TimeoutRespuesta');
            $table->string('Tipo',30);

            $table->foreign('IdServidor')->references('IdServidor')->on('Servidores');

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
        Schema::dropIfExists('Servicios');
    }
};
