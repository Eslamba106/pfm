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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('lang_name')->after('name')->nullable();
            $table->text('lang_address1')->after('address1')->nullable();
            $table->text('lang_address2')->after('address2')->nullable();
            $table->text('lang_address3')->after('address3')->nullable();// new update 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('lang_name');
            $table->dropColumn('lang_address1');
            $table->dropColumn('lang_address2');
            $table->dropColumn('lang_address3');
        });
    }
};
