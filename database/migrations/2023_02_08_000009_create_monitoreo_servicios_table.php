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
        Schema::create('Monitoreo_Servicio', function (Blueprint $table) {
            $table->id('IdMonitoreoServicio');
            $table->unsignedBigInteger('IdServicio');
            $table->integer('UsoCpu');
            $table->integer('UsoMemoria');
            $table->integer('UsoDisco');
            $table->date('FechaMonitoreo');
            $table->timestamps();

            $table->foreign('IdServicio')->references('IdServicio')->on('Servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Monitoreo_Servicio');
    }
};
