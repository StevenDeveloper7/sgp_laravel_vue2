<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_categoria')->nullable();
            $table->unsignedInteger('id_negocio')->nullable();
            $table->string('foto')->nullable();
            $table->string('codigo')->nullable();
            $table->string('nombre',50)->nullable();
            $table->string('descripcion',200)->nullable();
            $table->integer('unidad_medida')->nullable();
            $table->integer('valor')->nullable();
            $table->integer('stock')->nullable();
            $table->foreign('id_categoria')->references('id')->on('categoria__productos');
            $table->foreign('id_negocio')->references('id')->on('negocios');
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
        Schema::dropIfExists('productos');
    }
}
