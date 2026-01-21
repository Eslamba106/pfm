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
        Schema::create('rental_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('from')->nullable();
            $table->string('from_period')->nullable();
            $table->integer('to')->nullable();
            $table->string('to_period')->nullable();
            $table->integer('ledger_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_types');
    }
};
