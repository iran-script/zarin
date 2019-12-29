<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositingreceipt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depositingreceipt', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->BigInteger('baker_id')->unsigned();
            $table->foreign('baker_id')->references('id')->on('bakers');
            $table->BigInteger('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('city');
            $table->date('deposit_date');
            $table->Integer('deposit_amount');
            $table->String('flour_type' , 50);
            $table->BigInteger('flour_id')->unsigned();
            $table->foreign('flour_id')->references('id')->on('products');
            $table->Integer('number_bags');
             $table->BigInteger('flourfactory_id')->unsigned();
            $table->foreign('flourfactory_id')->references('id')->on('flourfactory');
            $table->Integer('branch_code');




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
        Schema::dropIfExists('depositingreceipt');
    }
}
