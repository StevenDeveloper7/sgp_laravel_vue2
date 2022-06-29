<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_usuario')->nullable();
            $table->unsignedInteger('id_negocio')->nullable();
            $table->unsignedInteger('id_estado')->nullable();
            $table->integer('valor_total')->nullable();
            $table->string('tiempo_entrega',200)->nullable();
            $table->date('fecha')->nullable();
            $table->integer('cantidad')->nullable();
            $table->foreign('id_negocio')->references('id')->on('negocios');
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->foreign('id_estado')->references('id')->on('estado_pedidos');
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
        Schema::dropIfExists('pedidos');
    }
}
