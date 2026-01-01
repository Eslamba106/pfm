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
        Schema::create('complaint_comment_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_registration_id')->constrained('complaint_registrations')->cascadeOnDelete();
            $table->text('old_comment')->nullable();
            $table->text('new_comment')->nullable();
            $table->text('message')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_comment_logs');
    }
};
