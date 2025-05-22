<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rma_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resolution')->nullable();
            $table->integer('rma_id')->unsigned();
            $table->foreign('rma_id')->references('id')->on('rma')->onDelete('cascade');
            $table->integer('order_item_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->foreign('rma_reason_id')->references('id')->on('rma_reasons')->onDelete('cascade');
            $table->integer('rma_reason_id')->unsigned();
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
        Schema::dropIfExists('rma_items');
    }
};