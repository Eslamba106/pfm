<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     *  `code`, `name`, `rental`, `is_taxable`,
     *  `vat_applicable_from`, `taxability`, `tax_rate`, `ledger_applicable_on`, `status`, `companyId
     */
    public function up(): void
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255)->nullable(); 
            $table->string('name', 255)->nullable(); 
            $table->tinyInteger('rental')->default(0); 
            $table->tinyInteger('is_taxable')->default(0); 
            $table->date('vat_applicable_from')->nullable();  
            $table->string('taxability', 255)->nullable(); 
            $table->double('tax_rate')->default(0);  
            $table->unsignedBigInteger('ledger_applicable_on')->default(0); 
            $table->tinyInteger('status')->default(1); 
            $table->unsignedBigInteger('company_id'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};
