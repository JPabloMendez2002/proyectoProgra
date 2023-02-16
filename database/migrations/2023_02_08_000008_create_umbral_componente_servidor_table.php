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
        Schema::create('Umbral_Componente_Servidor', function (Blueprint $table) {
            $table->id('IdParametro');
            $table->unsignedBigInteger('IdServidor');
            $table->unsignedBigInteger('IdComponente');
            $table->unsignedBigInteger('IdUmbral');
            $table->integer('Porcentaje');
            $table->timestamps();

            $table->foreign('IdServidor')->references('IdServidor')->on('Servidores');
            $table->foreign('IdComponente')->references('IdComponente')->on('Componente');
            $table->foreign('IdUmbral')->references('IdUmbral')->on('Umbral');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Umbral_Componente_Servidor');
    }
};
