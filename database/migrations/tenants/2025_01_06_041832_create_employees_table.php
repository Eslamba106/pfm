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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->enum('status' , ['active' , 'inactive'])->default('active');
            $table->string('mobile_dail_code');
            $table->string('mobile');
            $table->string('office_dail_code');
            $table->string('office');
            $table->string('whatsapp_dail_code');
            $table->string('whatsapp');
            $table->string('branch_id')->nullable();
            $table->string('extension_no');
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->foreignId('employee_type_id')->constrained('employee_types')->cascadeOnDelete();
            $table->unsignedBigInteger('company_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
