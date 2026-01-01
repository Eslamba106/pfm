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
        Schema::create('terminations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agreement_id')->constrained('agreements')->cascadeOnDelete() ;
            $table->foreignId('tenant_id')->nullable()->constrained('tenants')->cascadeOnDelete() ;
            $table->text('comment')->nullable();
            $table->string('applicant')->nullable();
            $table->json('unit_ids')->nullable();
            $table->enum('status' , ['approved' , 'rejected' , 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terminations');
    }
};
