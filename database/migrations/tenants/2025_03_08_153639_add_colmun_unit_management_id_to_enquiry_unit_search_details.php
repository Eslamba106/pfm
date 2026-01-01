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
        Schema::table('enquiry_unit_search_details', function (Blueprint $table) {
            $table->foreignId('unit_management_id')->after('property_management_id')->nullable()->constrained('unit_management')->cascadeOnDelete()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enquiry_unit_search_details', function (Blueprint $table) {
            $table->dropColumn('unit_management_id');
        });
    }
};
