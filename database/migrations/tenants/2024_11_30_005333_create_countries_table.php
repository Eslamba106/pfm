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
        // `code`, `name`, `dial_code`, `currency_name`, `currency_symbol`, `currency_code`, `den_val`
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 3); 
            $table->string('currency_name')->nullable();  
            $table->string('currency_code', 5)->nullable();  
            $table->string('currency_symbol')->nullable();  
            $table->string('dial_code', 10)->nullable(); 
            $table->string('den_val', 10)->nullable();  
            $table->string('branch_id')->nullable(); 
            $table->string('nationality')->nullable();   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
