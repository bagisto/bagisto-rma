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
        Schema::create('custom_rma_field', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->nullable()->default('0');
            $table->string('code')->unique();
            $table->string('label')->nullable();
            $table->string('type')->nullable();
            $table->string('is')->nullable();
            $table->boolean('is_required')->nullable()->default('0');
            $table->integer('position')->nullable();
            $table->string('input_validation')->nullable();
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
