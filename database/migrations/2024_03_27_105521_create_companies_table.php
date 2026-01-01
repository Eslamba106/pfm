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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('company_id', 255)->unique()->index();
            $table->string('domain', 500)->nullable();
            $table->unsignedInteger('user_count')->default(1);
            $table->unsignedInteger('building_count')->default(1);
            $table->unsignedInteger('units_count')->default(10);
            $table->unsignedInteger('branches_count')->default(1);
            $table->string('setup_cost')->nullable();
            $table->string('monthly_subscription_user')->nullable();
            $table->string('monthly_subscription_building')->nullable();
            $table->string('monthly_subscription_units')->nullable();
            $table->string('monthly_subscription_branches')->nullable();
            $table->string('creation_date', 255)->nullable();
            $table->string('company_applicable_date', 255)->nullable();
            $table->string('countryName', 255)->nullable();
            $table->string('countryCode', 50)->nullable();
            $table->string('region', 100)->nullable();
            $table->string('currency', 15)->nullable();
            $table->string('symbol', 100)->nullable();
            $table->string('currency_code', 255)->nullable();
            $table->string('denomination', 255)->nullable();
            $table->string('decimals', 255)->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->text('address3')->nullable();
            $table->string('mobile_dail_code', 255)->nullable();
            $table->string('mobile', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('email', 255)->nullable()->unique();
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->integer('reg_tax_status')->default(0)->nullable();
            $table->date('tax_reg_date')->nullable();
            $table->integer('tax_type')->default(0)->nullable();
            $table->date('applicable_date')->nullable(); 
            $table->double('tax_rate', 16, 2)->nullable();
            $table->string('vat_no', 150)->nullable();
            $table->string('group_vat_no', 255)->nullable();
            $table->string('vat_tin_no', 255)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('code', 50)->nullable();
            $table->string('pin', 50)->nullable();
            $table->string('location', 255)->nullable();
            $table->unsignedBigInteger('fax_dail_code')->default(0)->nullable();
            $table->string('fax', 15)->nullable();
            $table->unsignedBigInteger('phone_dail_code')->default(0)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('logo_image', 255)->nullable();
            $table->longText('signature')->nullable();
            $table->longText('seal')->nullable();
            $table->date('financial_year')->nullable();
            $table->date('book_begining')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->tinyInteger('common')->default(1)->nullable(); 
            $table->string('my_name', 255)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->unsignedBigInteger('countryid')->default(0);
            $table->integer('domain_code')->default(0)->nullable();
            $table->integer('schema_id')->nullable();
            $table->json('database_options')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
