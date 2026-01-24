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
        Schema::create('booking_r', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->date('booking_date');
            $table->date('booking_from');
            $table->date('booking_to');
            $table->unsignedBigInteger('rental_type_id');
            $table->decimal('summary_total', 10, 3)->default(0);
            $table->decimal('summary_discount', 10, 3)->default(0);
            $table->decimal('summary_gross', 10, 3)->default(0);
            $table->decimal('summary_vat', 10, 3)->default(0);
            $table->decimal('summary_levy', 10, 3)->nullable();
            $table->decimal('summary_net', 10, 3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_r');
    }
};
