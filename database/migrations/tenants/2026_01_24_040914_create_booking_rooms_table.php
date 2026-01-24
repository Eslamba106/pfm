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
        Schema::create('booking_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('room_id');
            $table->integer('days')->default(0);
            $table->decimal('rent_price', 10, 3)->default(0);
            $table->decimal('discount_per', 10, 3)->default(0);
            $table->decimal('discount', 10, 3)->default(0);
            $table->decimal('gross', 10, 3)->default(0);
            $table->decimal('vat_per', 10, 3)->default(0);
            $table->decimal('levy', 10, 3)->nullable();
            $table->decimal('net_total', 10, 3)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_rooms');
    }
};
