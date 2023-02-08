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
        Schema::create('Redimientos', function (Blueprint $table) {
            $table->unsignedBigInteger('IdServidor');
            $table->integer('UsoCpu');
            $table->integer('UsoMemoria');
            $table->integer('UsoDisco');
            $table->unsignedBigInteger('IdIntervalo');

            $table->foreign('IdServidor')->references('IdServidor')->on('Servidores');
            $table->foreign('IdIntervalo')->references('IdIntervalo')->on('Intervalos');

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
        Schema::dropIfExists('Redimientos');
    }
};
