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
        Schema::table('main_ledgers', function (Blueprint $table) {
            $table->string('credit')->nullable();//edit
            $table->string('credit_vat')->nullable();
            $table->string('debit')->nullable();
            $table->string('debit_vat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('main_ledgers', function (Blueprint $table) {
            $table->dropColumn([
                'credit',
                'credit_vat',
                'debit',
                'debit_vat',
            ]);
        });
    }
};
