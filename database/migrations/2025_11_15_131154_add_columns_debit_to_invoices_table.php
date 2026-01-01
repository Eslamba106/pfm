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
        Schema::table('invoices', function (Blueprint $table) {
               $table->string('credit')->nullable();
            $table->string('credit_vat')->nullable();
            $table->string('debit')->nullable(); // new update
            $table->string('debit_vat')->nullable();//edit
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'credit',
                'credit_vat',
                'debit',
                'debit_vat',
            ]);
        });
    }
};
