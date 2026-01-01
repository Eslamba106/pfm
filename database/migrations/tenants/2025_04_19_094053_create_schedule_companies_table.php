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
        Schema::create('schedule_companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_companies');
    }
};
