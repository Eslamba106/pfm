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
        Schema::create('proposal_units_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_unit_id')->constrained('proposal_units')->cascadeOnDelete();
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
        Schema::dropIfExists('proposal_units_services');
    }
};
