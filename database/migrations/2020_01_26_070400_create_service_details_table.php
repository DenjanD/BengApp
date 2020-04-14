<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_details', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->integer('kilometer');
            $table->time('service_start_time');
            $table->date('service_date');
            $table->char('vehicle_license', 10);
            $table->integer('service_cost');
            $table->integer('spart_cost');
            $table->integer('total_cost');
            $table->string('vehicle_name');
            $table->text('complaint_desc');
            $table->bigInteger('scategory')->unsigned();
            $table->time('service_end_time')->nullable();
            $table->text('service_desc');
            $table->timestamps();

            $table->foreign('id')->references('service_id')->on('services');
            $table->foreign('scategory')->references('scategory_id')->on('service_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_details');
    }
}
