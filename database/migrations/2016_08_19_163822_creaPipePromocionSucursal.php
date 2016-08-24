<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaPipePromocionSucursal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocion_sucursal', function (Blueprint $table) {
            
            $table->integer('promocion_id')->unsigned();
            $table->integer('sucursal_id')->unsigned();

            $table->timestamps();
            $table->foreign('promocion_id')->references('id')->on('promocions')->onDelete('cascade');
            $table->foreign('sucursal_id')->references('id')->on('sucursals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
