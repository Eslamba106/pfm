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
        Schema::create('complaint_registrations', function (Blueprint $table) {
            $table->id(); // complaint_registrations
            $table->string('complaint_no')->unique();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            // $table->foreignId('property_id')->nullable()->constrained('property')->cascadeOnDelete();
            $table->foreignId('block_id')->nullable()->constrained('block_management')->cascadeOnDelete();
            $table->foreignId('floor_id')->nullable()->constrained('floor_management')->cascadeOnDelete();
            $table->foreignId('unit_management_id')->nullable()->constrained('unit_management')->cascadeOnDelete();
            $table->foreignId('freezed_reason')->nullable()->constrained('freezings')->cascadeOnDelete();
            $table->foreignId('department')->nullable()->constrained('departments')->cascadeOnDelete();
            $table->string('department_head')->nullable() ;
            $table->foreignId('priority')->nullable()->constrained('priorities')->cascadeOnDelete();
            $table->foreignId('property_management_id')->nullable()->constrained('property_management')->cascadeOnDelete();
            $table->string('attachment')->nullable();
            $table->string('attachment_type')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('employee_type')->nullable();
            $table->string('schedule_date')->nullable();
            $table->string('complainer_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('complaint_category')->nullable();
            $table->string('complaint')->nullable();
            $table->longText('complaint_comment')->nullable();
            $table->longText('notes')->nullable();
            $table->longText('freezing_notes')->nullable();
            $table->string('worker')->nullable();
            $table->unsignedBigInteger('company_id')->default(1);
            $table->tinyInteger('notification_sent')->nullable();
            $table->enum('status' , ['open' , 'freezed' , 'closed'])->default('open'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_registerations');
    }
};
