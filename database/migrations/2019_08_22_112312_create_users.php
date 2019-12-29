<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->String('first_name' , 50);
            $table->String('last_name' , 50);
            $table->String('mobile' , 11);
            $table->String('phone' , 11);
            $table->String('smscode' , 200);
            $table->date('exp_smscode');
            $table->String('address',100);
            $table->String('email',100);
            $table->Boolean('user_status');
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
        Schema::dropIfExists('users');
    }
}
