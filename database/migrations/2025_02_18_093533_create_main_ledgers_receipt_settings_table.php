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
        Schema::create('main_ledgers_receipt_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_ledger_id')->constrained('main_ledgers')->cascadeOnDelete();
            $table->foreignId('receipt_settings_id')->constrained('receipt_settings')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_ledgers_receipt_settings');
    }
};
