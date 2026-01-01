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
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ledger_id')->nullable()->constrained('main_ledgers')->cascadeOnDelete();
            $table->string('invoice_prefix')->nullable();
            $table->string('invoice_suffix')->nullable();
            $table->string('invoice_width')->nullable();
            $table->string('invoice_start_number')->nullable();
            $table->string('invoice_name')->nullable();
            $table->string('invoice_type')->nullable();
            $table->string('invoice_with_logo')->nullable();
            $table->string('invoice_logo_position')->nullable();
            $table->string('invoice_format')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->date('invoice_date')->nullable();    
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_settings');
    }
};
