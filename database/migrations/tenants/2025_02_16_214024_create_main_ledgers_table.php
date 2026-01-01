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
        Schema::create('main_ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255)->nullable();
            $table->string('name', 255);
            $table->string('currency')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('nature')->nullable();
            $table->text('address')->nullable();
            $table->foreignId('country_id')->constrained('countries')->restrictOnDelete();
            $table->foreignId('group_id')->constrained('groups')->cascadeOnDelete();
            $table->tinyInteger('is_taxable')->default(0);
            $table->date('vat_applicable_from')->nullable();
            $table->double('tax_rate')->default(0);
            $table->tinyInteger('is_discount' )->nullable()->default(0);
            $table->tinyInteger('is_cash' )->nullable()->default(0);
            $table->tinyInteger('project_general_ledger' )->nullable()->default(0);
            $table->tinyInteger('maintain_bill_by_bill' )->nullable()->default(0);
            $table->tinyInteger('tax_applicable' )->nullable()->default(0);
            $table->tinyInteger('is_custom_vat' )->nullable()->default(0);
            $table->enum('status' , ['active' , 'inactive'])->default('active');
            $table->string('main_id')->nullable();
            $table->string('branch_id')->nullable();  
            $table->string('main_type')->nullable(); 
            $table->string('property_management_id')->nullable(); 
            $table->string('unit_management_id')->nullable(); 
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_ledgers');
    }
};
