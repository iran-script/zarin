<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('depo_id')->unsigned();
            $table->foreign('depo_id')->references('id')->on('depositing_receipt');
            $table->bigInteger('baker_id')->unsigned();
            $table->foreign('baker_id')->references('id')->on('bakers');
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');
            $table->bigInteger('navy_id')->unsigned();
            $table->foreign('navy_id')->references('id')->on('navy');
            $table->bigInteger('driver_id')->unsigned();
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->bigInteger('factory_id')->unsigned();
            $table->foreign('factory_id')->references('id')->on('flour_factory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
