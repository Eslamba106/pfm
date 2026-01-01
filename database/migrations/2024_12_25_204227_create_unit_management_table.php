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
        Schema::create('unit_management', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_management_id')->constrained('property_management')->cascadeOnDelete();
            $table->foreignId('block_management_id')->constrained('block_management')->cascadeOnDelete();
            $table->foreignId('floor_management_id')->constrained('floor_management')->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->foreignId('unit_description_id')->nullable()->constrained('unit_descriptions')->cascadeOnDelete();
            $table->foreignId('unit_condition_id')->nullable()->constrained('unit_conditions')->cascadeOnDelete();
            $table->foreignId('unit_type_id')->nullable()->constrained('unit_types')->cascadeOnDelete();
            $table->foreignId('unit_parking_id')->nullable()->constrained('unit_parkings')->cascadeOnDelete();
            $table->foreignId('view_id')->nullable()->constrained('views')->cascadeOnDelete();
            $table->string('rent_amount')->nullable();
            $table->enum('status' , ['active' , 'inactive'])->default('active');
            $table->enum('booking_status' , ['empty' , 'proposal' , 'booking' , 'agreement'])->default('empty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_management');
    }
};
