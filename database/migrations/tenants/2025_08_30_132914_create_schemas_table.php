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
        Schema::create('schemas', function (Blueprint $table) {
            $table->id();
            $table->date('applicable_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('name');
            $table->string('user_charge')->nullable();
            $table->string('user_count_from')->nullable();
            $table->string('user_count_to')->nullable();
            $table->string('building_charge')->nullable();
            $table->string('building_count_from')->nullable();
            $table->string('building_count_to')->nullable();
            $table->string('unit_charge')->nullable();
            $table->string('unit_count_from')->nullable();
            $table->string('unit_count_to')->nullable();
            $table->string('branch_charge')->nullable();
            $table->string('branch_count_from')->nullable();
            $table->string('branch_count_to')->nullable();
            $table->string('setup_cost')->nullable(); 
            $table->string('display')->nullable();
            $table->string('status')->nullable();
            $table->string('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schemas');
    }
};
