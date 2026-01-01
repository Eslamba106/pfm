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
        Schema::create('agreement_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agreement_id')->constrained('agreements')->cascadeOnDelete();
            $table->foreignId('property_id')->constrained('property_management')->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained('unit_management')->cascadeOnDelete();
            $table->decimal('rent_amount' , 8,2)->nullable();
            $table->string('rent_mode')->nullable();
            $table->string('rental_gl')->nullable();
            $table->string('total_area_amount')->nullable();
            $table->string('payment_mode')->nullable();
            $table->date('commencement_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->date('lease_break_date')->nullable();
            $table->string('lease_break_comment')->nullable();
            $table->decimal('vat_percentage' ,8,2)->nullable();
            $table->decimal('vat_amount' ,8,2)->nullable();
            $table->decimal('total_net_rent_amount' ,8,2)->nullable();
            $table->decimal('total_net_amount' ,8,2)->nullable();
            $table->decimal('security_deposit' ,8,2)->nullable();
            $table->decimal('security_deposit_amount' ,8,2)->nullable();
            $table->string('is_rent_inclusive_of_ewa')->nullable();
            $table->string('ewa_limit_mode')->nullable();
            $table->string('ewa_limit')->nullable();
            $table->string('notice_period')->nullable();
            $table->decimal('total' , 8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreement_units');
    }
};
