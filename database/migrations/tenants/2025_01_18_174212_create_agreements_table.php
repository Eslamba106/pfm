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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->string('proposal_no')->nullable();
            $table->string('enquiry_no')->nullable();
            $table->string('booking_no')->nullable();
            $table->string('agreement_no')->unique();
            $table->string('total_no_of_required_units')->nullable();
            $table->date('agreement_date');
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->enum('gender' , ['male' , 'female'])->nullable();
            $table->string('id_number')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('group_company_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('designation')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('whatsapp_no')->nullable();
            $table->string('company_name')->nullable();
            $table->string('fax_no')->nullable();
            $table->string('telephone_no')->nullable();
            $table->string('other_contact_no')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->foreignId('country_id')->constrained('country_masters')->cascadeOnDelete();
            $table->foreignId('nationality_id')->nullable()->constrained('country_masters')->cascadeOnDelete();
            $table->string('passport_no')->nullable();
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
            $table->foreignId('live_with_id')->nullable()->constrained('live_withs')->cascadeOnDelete();
            $table->foreignId('business_activity_id')->nullable()->constrained('business_activities')->cascadeOnDelete();
            $table->enum('status' , ['proposal' , 'booking' , 'agreement' , 'canceled' , 'completed' , 'pending']);
            $table->enum('booking_status' , ['proposal' , 'booking' , 'agreement','signed' ])->default('agreement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
