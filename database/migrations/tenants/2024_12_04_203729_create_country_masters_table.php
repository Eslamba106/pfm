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
        Schema::create('country_masters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();
            $table->string('country_code');
            $table->string('currency_name');
            $table->string('currency_symbol')->nullable();
            $table->foreignId('region_id')->constrained('regions')->cascadeOnDelete();
            $table->string('nationality_of_owner');
            $table->string('no_of_decimals')->default(2);
            $table->string('international_currency_code')->nullable();
            $table->string('denomination_name')->nullable();
            $table->string('branch_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_masters');
    }
};
