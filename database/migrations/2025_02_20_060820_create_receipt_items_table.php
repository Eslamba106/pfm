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
        Schema::create('receipt_items', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('type')->nullable();
            $table->string('ref')->nullable();
            $table->string('tenant_type')->nullable();
            $table->string('net_amount')->nullable();
            $table->string('paid_amount')->nullable();
            $table->double('balance_due')->nullable();
            $table->string('amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_items');
    }
};
