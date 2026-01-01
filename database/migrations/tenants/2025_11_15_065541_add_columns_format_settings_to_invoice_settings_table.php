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
        Schema::table('invoice_settings', function (Blueprint $table) {
            $table->string('format_color')->nullable();//edit
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoice_settings', function (Blueprint $table) {
            $table->dropColumn([
                'format_color',
                'background_color',
                'company_email',
                'company_phone',
                'company_fax',
                'company_address',
                'company_vat_no',
                'tenant_email',
                'tenant_phone',
                'tenant_fax',
                'tenant_address',
                'tenant_vat_no',
                'qr_code_width',
                'qr_code_height',
            ]);
        });
    }
};
