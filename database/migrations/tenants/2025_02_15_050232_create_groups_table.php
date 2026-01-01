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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255)->nullable();
            $table->string('name', 255);
            $table->string('display_name', 255)->nullable();
            $table->string('result', 255)->nullable();
            $table->string('nature', 255)->nullable();
            $table->integer('group_id')->default(0)->nullable();
            $table->tinyInteger('is_projects_parent_group')->default(0);
            $table->tinyInteger('enable_auto_code')->default(0);
            $table->enum('status' , ['active' , 'inactive'])->default('active');
            $table->string('branch_id')->nullable();  
            $table->string('property_id')->nullable();  
 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
