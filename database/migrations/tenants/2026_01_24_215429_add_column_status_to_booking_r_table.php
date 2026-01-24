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
        Schema::table('booking_r', function (Blueprint $table) {
            $table->string('status')->after('summary_net')->nullable();
            $table->date('checked_out_at')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_r', function (Blueprint $table) {
            $table->dropColumn('status' ,'checked_out_at');
        });
    }
};
