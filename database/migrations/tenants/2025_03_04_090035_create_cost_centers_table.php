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
        Schema::create('cost_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('cost_center_category_id')->constrained('cost_center_categories')->restrictOnDelete();
            $table->string('code')->nullable();
            $table->unsignedBigInteger('main_id')->nullable();
            $table->string('main_type')->nullable();
            $table->double('all_expenses')->nullable();
            $table->double('all_income')->nullable();
            $table->integer('branch_id')->nullable();
            $table->enum('status' , ['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost_centers');
    }
};
