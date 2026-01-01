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
        Schema::create('sales_return_settings', function (Blueprint $table) {
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
            $table->string('format_color')->nullable();
            $table->string('background_color')->nullable();
            $table->tinyInteger('company_email')->nullable();
            $table->tinyInteger('company_phone')->nullable();
            $table->tinyInteger('company_fax')->nullable();
            $table->tinyInteger('company_address')->nullable();
            $table->tinyInteger('company_vat_no')->nullable();
            $table->tinyInteger('tenant_email')->nullable();
            $table->tinyInteger('tenant_phone')->nullable();
            $table->tinyInteger('tenant_fax')->nullable();
            $table->tinyInteger('tenant_address')->nullable();
            $table->tinyInteger('tenant_vat_no')->nullable();
            $table->string('qr_code_width')->nullable();
            $table->string('qr_code_height')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_return_settings');
    }
};
