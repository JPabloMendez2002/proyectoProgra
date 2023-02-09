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
            $table->id('IdParametroServicio');
            $table->unsignedBigInteger('IdServicio');
            $table->string('Nombre',20)->unique();
            $table->text('Descripcion');
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
        Schema::dropIfExists('Parametros_Servicios');
    }
};
