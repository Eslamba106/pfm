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
        Schema::create('enquiry_unit_search_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enquiry_id')->constrained('enquiries')->cascadeOnDelete();
            $table->foreignId('property_management_id')->nullable()->constrained('property_management')->cascadeOnDelete();
            $table->foreignId('unit_description_id')->nullable()->constrained('unit_descriptions')->cascadeOnDelete();
            $table->foreignId('unit_type_id')->nullable()->constrained('unit_types')->cascadeOnDelete();
            $table->foreignId('unit_condition_id')->nullable()->constrained('unit_conditions')->cascadeOnDelete();
            $table->foreignId('view_id')->nullable()->constrained('views')->cascadeOnDelete();
            // $table->integer('unit_management_id')->nullable();
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->string('property_type')->nullable();
            $table->string('city')->nullable();
            $table->string('total_area_required')->nullable();
            $table->string('area_measurement')->nullable();
            $table->text('comment')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->string('rent_amount')->nullable();
            $table->timestamps();
            // `unit_management_id` bigint(20) UNSIGNED DEFAULT NULL,

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry_unit_search_details');
    }
};
