<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('purchase_id');
            $table->bigInteger('spart')->unsigned();
            $table->bigInteger('supplier')->unsigned();
            $table->date('purchase_date');
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();

            $table->foreign('spart')->references('spart_id')->on('spare_parts');
            $table->foreign('supplier')->references('supplier_id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
