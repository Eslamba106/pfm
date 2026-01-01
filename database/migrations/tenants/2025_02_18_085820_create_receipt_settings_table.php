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
            $table->string('branch_id')->nullable();
            $table->string('address_status')->nullable();
            $table->string('signature_status')->nullable();
            $table->string('balance_amount_status')->nullable();
            $table->string('receipt_with_logo')->nullable();
            $table->string('receipt_logo_position')->nullable();
            $table->string('receipt_format')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
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
