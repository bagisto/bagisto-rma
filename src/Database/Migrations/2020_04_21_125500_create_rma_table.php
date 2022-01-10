<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rma', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resolution')->nullable();
            $table->longtext('information');
            $table->string('order_status')->nullable();
            $table->string('rma_status')->nullable();
            $table->integer('order_id')->unsigned();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('rma');
    }
}
