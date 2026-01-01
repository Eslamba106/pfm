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
        Schema::create('property_management', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('branch_id')->nullable();
            $table->foreignId('ownership_id')->nullable()->constrained('ownerships')->cascadeOnDelete();
            $table->foreignId('property_type_id')->nullable()->constrained('property_types')->cascadeOnDelete();
            $table->string('building_no')->nullable();
            $table->string('block_no')->nullable();
            $table->string('road')->nullable();
            $table->string('location')->nullable();
            $table->string('city')->nullable();
            $table->foreignId('country_master_id')->nullable()->constrained('country_masters')->cascadeOnDelete();
            $table->date('established_on')->nullable();
            $table->date('registration_on')->nullable();
            $table->string('tax_no')->nullable();
            $table->string('municipality_no')->nullable();
            $table->string('electricity_no')->nullable();
            $table->string('land_lord_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_no')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('dail_code_telephone')->nullable();
            $table->string('dail_code_fax')->nullable();
            $table->string('dail_code_mobile')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('total_area')->nullable();
            $table->string('insurance_provider')->nullable();
            $table->date('insurance_period_from')->nullable();
            $table->date('insurance_period_to')->nullable();
            $table->string('insurance_type')->nullable();
            $table->string('insurance_policy_no')->nullable();
            $table->string('insurance_holder')->nullable();
            $table->string('premium_amount')->nullable();
            $table->enum('status' , ['active' , 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_management');
    }
};
