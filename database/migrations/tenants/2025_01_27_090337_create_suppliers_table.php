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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('dail_code_contact_no')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('dail_code_whatsapp_no')->nullable();
            $table->string('whatsapp_no')->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('contact_person')->nullable();
            $table->enum('status' , ['active' , 'inactive'])->default('active');
            $table->string('tax_registration')->nullable();
            $table->string('vat_no')->nullable(); 
            $table->string('branch_id')->nullable(); 
            $table->string('company_id')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
