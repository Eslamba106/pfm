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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('ledger_id');
            $table->double('balance_due')->nullable();
            $table->tinyInteger('voucher_type')->nullable();
            $table->string('receipt_ref')->nullable();
            $table->date('receipt_date')->nullable();
            $table->double('receipt_amount')->nullable();
            $table->tinyInteger('is_advance')->nullable();
            $table->string('advance_ref')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
