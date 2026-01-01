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
        Schema::table('unit_types', function (Blueprint $table) {
            $table->foreignId('unit_description_id')->after('code')->nullable()->constrained('unit_descriptions')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unit_types', function (Blueprint $table) {
            $table->dropColumn('unit_description_id');
        });
    }
};
