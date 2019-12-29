<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrivers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->String('personal_code' , 20);
            $table->String('national_code' , 10)->unique();
            $table->String('first_name' , 50);
            $table->String('last_name' , 50);
            $table->BigInteger('employmenttype_id');
            $table->String('father_name' , 50);
            $table->String('birth_number');
            $table->String('birth_place' , 50);
            $table->String('cert_city' , 50);
            $table->date('bithday');
            $table->String('mobile' , 11);
            $table->String('phone' , 11);
            $table->String('cert_number' , 50);
            $table->date('expire_helath_card');
            $table->date('expire_smart_card');
            $table->String('posta_code' , 10);
            $table->String('address' , 50);
            $table->String('sheba_bank' , 50);
            $table->String('bank_account_number' , 50);
            $table->bigInteger('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->float('persent_insurance_driver');
            $table->float('persent_tax');
            $table->float('persent_fractions');
            $table->float('persent_googd_job');
            $table->Boolean('status');
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
        Schema::dropIfExists('drivers');
    }
}
