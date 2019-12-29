<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotalPriceDriver extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_price_driver', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->BigInteger('driver_id')->unsigned();
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->BigInteger('totalprice')->unsigned();
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
        Schema::dropIfExists('total_price_driver');
    }
}
