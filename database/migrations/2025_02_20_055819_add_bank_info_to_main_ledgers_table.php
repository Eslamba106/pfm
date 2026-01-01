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
            $table->string('account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('account_no')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('iban_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('main_ledgers', function (Blueprint $table) {
            $table->dropColumn('iban_no');
            $table->dropColumn('swift_code');
            $table->dropColumn('account_no');
            $table->dropColumn('branch');
            $table->dropColumn('bank_name');
            $table->dropColumn('account_name');
        });
    }
};
