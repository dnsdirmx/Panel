<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCiudadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cve_ent');
            $table->string('cve_mun');
            $table->string('nom_mun');
            $table->string('cve_cab');
            $table->string('nom_cab');
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
        Schema::drop('ciudads');
    }
}
