<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nit',20)->nullable();
            $table->string('nombre_completo',150)->nullable();
            $table->string('telefono',20)->nullable();
            $table->string('direccion',100)->nullable();
            $table->string('foto',50)->nullable();
            $table->string('descripción',200)->nullable();
            $table->unsignedInteger('id_ciudad')->nullable();
            $table->unsignedInteger('id_usuario')->nullable();
            $table->unsignedInteger('id_categoria')->nullable();
            $table->string('long',100)->nullable();
            $table->string('lat',100)->nullable();
            $table->integer('canal')->nullable();
            $table->time('hora_apertura')->nullable();
            $table->time('hora_cierre')->nullable();
            $table->foreign('id_categoria')->references('id')->on('categoria_negocios');
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->foreign('id_ciudad')->references('id')->on('ciudads');
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
        Schema::dropIfExists('negocios');
    }
}
