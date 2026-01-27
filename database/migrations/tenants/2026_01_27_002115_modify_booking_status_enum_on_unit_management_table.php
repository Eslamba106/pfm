<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
           DB::statement("
            ALTER TABLE unit_management
            MODIFY booking_status 
            ENUM('empty','booked','agreement','proposal','enquiry','maintenance','booking')
            NOT NULL
            DEFAULT 'empty'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
           DB::statement("
            ALTER TABLE unit_management 
            MODIFY booking_status 
            ENUM('empty','booked','agreement','proposal','enquiry','booking','maintenance')
            NOT NULL
            DEFAULT 'empty'
        ");
    }
};
