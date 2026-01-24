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
            $table->integer('levy_id')->nullable();
            $table->decimal('levy_percentage' , 8,3)->after('levy_id')->nullable();
            $table->date('levy_date')->after('levy_percentage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['levy_id' , 'levy_percentage' , 'levy_date']);
        });
    }
};
