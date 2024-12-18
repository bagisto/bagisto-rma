<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_rma_option_field', function (Blueprint $table) {
            $table->id();
            $table->integer('additional_rma_field_id');
            $table->string('option_name')->nullable();
            $table->string('option_value')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_rma_field');
    }
};