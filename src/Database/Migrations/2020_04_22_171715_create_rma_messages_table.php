<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRmaMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rma_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('message');
            $table->foreign('rma_id')->references('id')->on('rma')->onDelete('cascade');
            $table->integer('rma_id')->unsigned();
            $table->boolean('is_admin')->nullable();
            $table->longText('attachment_path')->nullable();
            $table->longText('attachment')->nullable();
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
        Schema::dropIfExists('rma_messages');
    }
}