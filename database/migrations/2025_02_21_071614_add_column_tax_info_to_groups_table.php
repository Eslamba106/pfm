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
        Schema::table('groups', function (Blueprint $table) {
            $table->tinyInteger('is_taxable')->nullable();
            $table->date('vat_applicable_from')->nullable();
            $table->double('tax_rate')->nullable();
            $table->tinyInteger('tax_applicable' )->nullable()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('tax_applicable');
            $table->dropColumn('tax_rate');
            $table->dropColumn('vat_applicable_from');
            $table->dropColumn('is_taxable');
        });
    }
};
