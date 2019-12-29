<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlourfactory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flourfactory', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->String('factory_name' , 15);
            $table->BigInteger('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('city');
            $table->Integer('weight_bag');
            $table->String('phone' , 15);
            $table->Boolean('Status');
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
        Schema::dropIfExists('flourfactory');
    }
}
