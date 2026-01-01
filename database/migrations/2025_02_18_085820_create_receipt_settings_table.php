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
        Schema::create('receipt_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('prefix')->nullable();
            $table->string('sufix')->nullable();
            $table->string('starting_number')->nullable();
            $table->string('total_digit')->nullable();
            $table->string('result')->nullable();
            $table->string('prefix_with_zero')->nullable();
            $table->date('applicable_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_settings');
    }
};
