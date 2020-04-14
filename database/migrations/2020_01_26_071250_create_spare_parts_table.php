<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spare_parts', function (Blueprint $table) {
            $table->bigIncrements('spart_id');
            $table->string('name');
            $table->string('brand');
            $table->integer('price');
            $table->integer('quantity');
            // $table->binary('image');
            $table->bigInteger('category')->unsigned();
            $table->timestamps();

            $table->foreign('category')->references('sp_category_id')->on('spare_parts_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spare_parts');
    }
}
