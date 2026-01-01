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
            $table->string('code', 3)->unique(); 
            $table->string('currency_name')->nullable(); 
            $table->string('currency_code_en', 3)->nullable(); 
            $table->string('currency_code_ar', 3)->nullable(); 
            $table->string('currency_symbol', 10)->nullable(); 
            $table->string('dial_code', 10)->nullable(); 
            $table->string('den_val', 10)->nullable(); 
            $table->tinyInteger('is_master')->default(1); 
            // $table->foreignId('region_id')->constrained('regions')->cascadeOnDelete();
            $table->string('nationality_of_owner');
            $table->string('no_of_decimals')->default(2);
            $table->string('international_currency_code')->nullable();
            $table->string('denomination_name')->nullable();
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
