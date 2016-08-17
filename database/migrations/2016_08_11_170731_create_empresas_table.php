<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_contacto');
            $table->string('name');
            $table->string('estado');
            $table->string('ciudad');
            $table->string('direccion');
            $table->string('telefono');

            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();

            $table->integer('giro_id')->unsigned();
            $table->string('cod_promotor');

            $table->timestamps();

            $table->foreign('giro_id')->references('id')->on('giros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('empresas');
    }
}
