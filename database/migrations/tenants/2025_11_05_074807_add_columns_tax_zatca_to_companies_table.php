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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('organization_unit_name')->nullable();
            $table->string('invoice_type', 5)->nullable();
            $table->string('environment', 20)->nullable();
            $table->string('short_address', 8)->nullable();
            $table->string('otp', 8)->nullable();
            $table->string('company_category', 255)->nullable();
            $table->string('zip_code', 20)->nullable();

            $table->longText('compliance_certificate')->nullable();
            $table->longText('compliance_secret')->nullable();
            $table->string('compliance_request_id', 50)->nullable();

            $table->longText('production_certificate')->nullable();
            $table->longText('production_certificate_secret')->nullable();
            $table->string('production_certificate_request_id', 50)->nullable();

            $table->longText('private_key')->nullable();
            $table->longText('public_key')->nullable();
            $table->longText('csrKey')->nullable();

            $table->string('env_type', 150)->nullable();
            $table->string('commercial_registration_number', 50)->nullable();

            $table->boolean('e_invoice')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'organization_unit_name',
                'invoice_type',
                'environment',
                'short_address',
                'otp',
                'company_category',
                'compliance_certificate',
                'compliance_secret',
                'compliance_request_id',
                'production_certificate',
                'production_certificate_secret',
                'production_certificate_request_id',
                'private_key',
                'public_key',
                'csrKey',
                'env_type',
                'commercial_registration_number',
                'e_invoice',
            ]);

        });
    }
};
