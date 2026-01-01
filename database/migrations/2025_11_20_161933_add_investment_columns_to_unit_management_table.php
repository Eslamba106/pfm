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
            $table->decimal('return')->nullable();
            $table->string('return_mode')->nullable();
            $table->tinyInteger('investment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unit_management', function (Blueprint $table) {
            $table->drobColumns([
                'return',
                'investment',
                'return_mode',
            ]);
        });
    }
};
