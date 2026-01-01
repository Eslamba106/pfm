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
        Schema::create('sales_return_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_return_id')->constrained('sales_returns')->cascadeOnDelete(); 
            $table->foreignId('agreement_id')->constrained('agreements')->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained('unit_management')->cascadeOnDelete();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('building_id')->constrained('property_management')->cascadeOnDelete();

            $table->double('rent_amount');
            $table->string('service')->nullable();//edit
            $table->double('vat');
            $table->double('total');
            $table->integer('service_id')->nullable();
            $table->string('branch_id')->nullable();
            $table->string('category')->nullable();
            $table->double('paid_amount')->nullable();
            $table->double('balance_due')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_return_items');
    }
};
