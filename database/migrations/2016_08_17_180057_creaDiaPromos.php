<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaDiaPromos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_promos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dia');
            $table->integer('promocion_id')->unsigned();
            $table->timestamps();
            $table->foreign('promocion_id')->references('id')->on('promocions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dia_promos');
    }
}
