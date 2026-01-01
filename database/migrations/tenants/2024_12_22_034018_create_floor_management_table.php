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
        Schema::create('floor_management', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_management_id')->constrained('property_management')->cascadeOnDelete();
            $table->foreignId('block_management_id')->constrained('block_management')->cascadeOnDelete();
            $table->foreignId('floor_id')->constrained('floors')->cascadeOnDelete();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->string('branch_id')->nullable();
            $table->unsignedBigInteger('company_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floor_management');
    }
};
