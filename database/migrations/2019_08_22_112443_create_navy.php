<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navy', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->String('plates_number' , 20);
            $table->String('insurance_number' , 20);
            $table->BigInteger('employmenttype_id');
            $table->String('chassis_number' , 20);
            $table->date('year_making');
            $table->String('spare_serial' , 20);
            $table->date('expire_insurance');
            $table->date('expire_technical');
            $table->BigInteger('driver_id')->unsigned();
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->Integer('age_car');
            $table->String('plate_serial' , 20);
            $table->BigInteger('camiontype_id')->unsigned();
            $table->foreign('camiontype_id')->references('id')->on('camiontypes');
            $table->String('motor_number' , 20);
            $table->String('veterinary_code' , 20);
            $table->Boolean('status');
            $table->Integer('capacity');
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
        Schema::dropIfExists('navy');
    }
}
