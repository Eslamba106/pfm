<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('complaint_no')->unique();
            $table->string('tenant_id');
            $table->string('complainer_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('property_id');
            $table->string('block_id')->nullable();
            $table->string('floor_id')->nullable();
            $table->string('unit_management_id')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('complaint_category')->nullable();
            $table->string('complaint')->nullable();
            $table->longText('complaint_comment')->nullable();
            $table->longText('notes')->nullable();
            $table->longText('freezing_notes')->nullable();
            $table->string('freezed_reason')->nullable();
            $table->string('department')->nullable();
            $table->string('department_head')->nullable();
            $table->string('priority')->nullable();
            $table->string('worker')->nullable();
            $table->tinyInteger('notification_sent')->nullable();
            $table->enum('status' , ['open' , 'freezed' , 'closed'])->default('open');

            $table->string('property_management')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaint_registrations');
    }
};
