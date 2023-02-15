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
        Schema::create('Parametros_Servicios', function (Blueprint $table) {
            $table->unsignedBigInteger('IdParametroServicio');
            $table->unsignedBigInteger('IdServicio');
            $table->timestamps();

            $table->foreign('IdParametroServicio')->references('IdParametro')->on('Parametro');
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
        Schema::dropIfExists('Parametros_Servicios');
    }
};
