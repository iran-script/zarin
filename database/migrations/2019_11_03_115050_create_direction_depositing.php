<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectionDepositing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direction_price', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('city_id_from')->unsigned();
            $table->foreign('city_id_from')->references('id')->on('city');
            $table->bigInteger('city_id_to')->unsigned();
            $table->foreign('city_id_to')->references('id')->on('city');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('direction_price');
    }
}
