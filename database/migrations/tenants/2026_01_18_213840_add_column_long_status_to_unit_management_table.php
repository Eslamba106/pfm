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
        Schema::table('unit_management', function (Blueprint $table) {
            $table->string('long_status')->nullable()->after('status');
            $table->string('reservation_status')->nullable()->after('long_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unit_management', function (Blueprint $table) {
            $table->dropColumn('long_status');
            $table->dropColumn('reservation_status');
        });
    }
};
