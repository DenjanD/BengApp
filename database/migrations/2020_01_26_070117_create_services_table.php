<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('service_id');
            $table->bigInteger('teller')->unsigned();
            $table->bigInteger('customer')->unsigned();
            $table->bigInteger('technician')->unsigned();
            $table->enum('status', ['Done','Working','Pending']);
            $table->timestamps();

            $table->foreign('teller')->references('user_id')->on('users');
            $table->foreign('customer')->references('customer_id')->on('customers');
            $table->foreign('technician')->references('technician_id')->on('technicians');
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
