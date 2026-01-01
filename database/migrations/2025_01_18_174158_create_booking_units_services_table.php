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
        Schema::create('booking_units_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_unit_id')->constrained('booking_units')->cascadeOnDelete();
            $table->string('other_charge_type')->nullable();
            $table->string('charge_mode')->nullable();
            $table->decimal('amount',8,2)->nullable();
            $table->decimal('vat',8,2)->nullable();
            $table->decimal('total',8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_units_services');
    }
};
