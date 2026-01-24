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
        Schema::create('booking_guests', function (Blueprint $table) {
            $table->id();

            $table->integer('booking_id')  ;
            $table->integer('room_id') ;

            $table->enum('guest_type', ['adult', 'child']); 

            $table->string('full_name');
            $table->enum('gender', ['male', 'female']);
            $table->date('dob');
            $table->unsignedInteger('age');

            $table->enum('id_type', ['passport', 'id_card', 'driving_license']);
            $table->string('id_file');  

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_guests');
    }
};
