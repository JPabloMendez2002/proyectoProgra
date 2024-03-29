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
        Schema::create('Monitoreo_Servidor', function (Blueprint $table) {
            $table->id('IdMonitoreo');
            $table->unsignedBigInteger('IdServidor');
            $table->timestamp('FechaMonitoreo',$precision = 0);
            $table->integer('UsoCpu');
            $table->integer('UsoMemoria');
            $table->integer('UsoDisco');
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
        Schema::dropIfExists('Monitoreo_Servidor');
    }
};
