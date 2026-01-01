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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->cascadeOnDelete();
            $table->foreignId('asset_group_id')->nullable()->constrained('asset_groups')->cascadeOnDelete();
            $table->date('purchase_date')->nullable();
            $table->string('amc_ref')->nullable();
            $table->date('warranty_expiry')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('warranty_provider')->nullable();
            $table->string('warranty_type')->nullable();
            $table->string('maintenance_type')->nullable();
            $table->string('amc_maintenance_type')->nullable();
            $table->string('amc_warranty_type')->nullable();
            $table->string('amc_amount')->nullable();
            $table->string('amc_provider')->nullable();
            $table->enum('status' , ['active' , 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
