<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('province_id')->unsigned();
            $table->foreign('province_id')->references('id')->on('city');
            $table->bigInteger('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('city');
            $table->bigInteger('flourfactory_id')->unsigned();
            $table->foreign('flourfactory_id')->references('id')->on('flour_factory');
            $table->bigInteger('driver_id')->unsigned();
            $table->foreign('driver_id')->references('id')->on('drivers');

            $table->bigInteger('navy_id')->unsigned();
            $table->foreign('navy_id')->references('id')->on('navy');
            $table->bigInteger('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('city');



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
        Schema::dropIfExists('services');
    }
}
