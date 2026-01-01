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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->decimal('rent_amount', 10, 2);
            $table->string('rent_mode');
            $table->decimal('total_service_amount', 10, 2);
            $table->decimal('vat_amount', 10, 2);
            $table->string('currency', 5)->default('BHD');
            $table->string('billing_month_year');
            $table->foreignId('unit_id')->constrained('unit_management')->onDelete('cascade');
            $table->foreignId('agreement_id')->constrained('agreements')->onDelete('cascade');
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->string('service')->nullable();
            $table->string('invoice_status')->nullable();
            $table->string('category')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('branch_id')->nullable(); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
