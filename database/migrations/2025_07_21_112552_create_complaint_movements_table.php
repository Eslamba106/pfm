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
        Schema::create('complaint_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained('complaint_registrations')->cascadeOnDelete(); 
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('activity');
            $table->string('attachment')->nullable();
            $table->string('attachment_type')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('user_id')->nullable();
            $table->tinyInteger('employee_id')->nullable();
            $table->tinyInteger('department_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_movements');
    }
};
