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
        Schema::create('Alertas_Servidor', function (Blueprint $table) {
            $table->unsignedBigInteger('IdServidor');
            $table->boolean('Monitoreo');
            $table->timestamps();

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
        Schema::dropIfExists('Alertas_Servidor');
    }
};
