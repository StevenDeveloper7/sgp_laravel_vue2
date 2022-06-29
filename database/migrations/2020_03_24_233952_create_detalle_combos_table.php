<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCombosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_combos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_combo')->nullable();
            $table->unsignedInteger('id_producto')->nullable();
            //$table->integer('cantidad')->nullable();
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->foreign('id_combo')->references('id')->on('combos');
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
        Schema::dropIfExists('detalle_combos');
    }
}
