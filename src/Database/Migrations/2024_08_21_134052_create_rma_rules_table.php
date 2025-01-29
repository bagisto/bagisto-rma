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
        Schema::create('rma_rules', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('rule_description')->nullable();
            $table->boolean('status')->nullable();
            $table->string('exchange_period')->nullable();
            $table->string('return_period')->nullable();
            $table->boolean('default')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rma_rules');
    }
};
