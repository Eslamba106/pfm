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
        Schema::create('receipts_payment_method', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receipt_id')->constrained('receipts')->cascadeOnDelete();
            $table->foreignId('main_ledger_id')->constrained('main_ledgers')->cascadeOnDelete();
            $table->decimal('amount');
            $table->string('bank_name')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('branch_id')->nullable();
            $table->date('cheque_date')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts_payment_method');
    }
};
