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
        Schema::create('asset_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('amc_id')->nullable()->constrained('amc_providers')->cascadeOnDelete();
            $table->foreignId('asset_id')->nullable()->constrained('assets')->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->string('date');
            $table->enum('status' , ['yes' , 'no'])->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_schedules');
    }
};
