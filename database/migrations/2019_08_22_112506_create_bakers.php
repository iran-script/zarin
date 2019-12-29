<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBakers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bakers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->String('first_name' , 50);
            $table->String('last_name' , 50);
            $table->String('address' , 200);
            $table->String('phone' , 11);
            $table->String('mobile' , 11);
            $table->date('birthday');
            $table->String('national_code' , 15);
            $table->String('birth_number' , 15);
            $table->String('postal_code' , 15);
            $table->BigInteger('bakingtype_id');
            $table->BigInteger('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('city');
            $table->BigInteger('zone_id')->unsigned();
            $table->foreign('zone_id')->references('id')->on('city');
            $table->float('lat');
            $table->float('lng');
            $table->Integer('quata_number');
            $table->String('desc' , 1000);
            $table->Boolean('violation');
            $table->String('reason_violation' , 500);
            $table->Boolean('free_cook');
            $table->Boolean('status');
            $table->Boolean('sick');
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
        Schema::dropIfExists('bakers');
    }
}
