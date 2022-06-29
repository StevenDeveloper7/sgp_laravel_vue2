<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nit');
            $table->string('nombre',100);
            $table->string('telefono',15);
            $table->string('direccion',100);
            $table->string('email',50)->nullable();
            $table->string('logo')->nullable();
            $table->unsignedInteger('id_admin')->nullable();
            $table->foreign('id_admin')->references('id')->on('usuarios');
            $table->integer('comision_lente')->nullable();
            $table->integer('comision_montura')->nullable();
            $table->integer('iva')->nullable();
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
        Schema::dropIfExists('configuracions');
    }
}
