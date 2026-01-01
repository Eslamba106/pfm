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
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->cascadeOnDelete();
            $table->foreignId('booking_status_id')->nullable()->constrained('enquiry_statuses')->cascadeOnDelete();
            $table->foreignId('booking_request_status_id')->nullable()->constrained('enquiry_request_statuses')->cascadeOnDelete();
            $table->foreignId('agent_id')->nullable()->constrained('agents')->cascadeOnDelete();
            $table->string('decision_maker')->nullable();
            $table->string('decision_maker_designation')->nullable();
            $table->string('current_office_location')->nullable();
            $table->string('reason_of_relocation')->nullable();
            $table->string('budget_for_relocation_start')->nullable();
            $table->string('budget_for_relocation_end')->nullable();
            $table->string('no_of_emp_staff_strength')->nullable();
            $table->string('time_frame_for_relocation')->nullable();
            $table->date('relocation_date')->nullable();
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_details');
    }
};
