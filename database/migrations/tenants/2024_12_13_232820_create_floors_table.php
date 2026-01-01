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
        Schema::create('floors', function (Blueprint $table) {
            $table->id();
            // $table->tinyInteger('form_data_store')->default(0);
            // $table->tinyInteger('floor_no_zero')->default(0);
            $table->integer('width')->default(0);
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('floor_no')->nullable();
            $table->string('mode')->default('single');
            // $table->tinyInteger('floor_with_prefix')->default(0);
            $table->string('prefix')->nullable();
            $table->enum('status' , ['active','inactive'])->default('active');
            $table->unsignedBigInteger('company_id')->default(0);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floors');
    }
};
