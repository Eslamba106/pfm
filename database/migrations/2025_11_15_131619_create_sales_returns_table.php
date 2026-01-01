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
        Schema::create('sales_returns', function (Blueprint $table) {
            $table->id();//edit

            $table->string('invoice_id')->unique();
            $table->string('invoice_number')->unique();
            $table->unsignedBigInteger('tenant_id')->default(0);
            $table->date('invoice_date');
            $table->string('invoice_month_year')->nullable();
            //            $table->string('billing_month_year');
            $table->enum('status', ['paid', 'unpaid', 'partially_paid'])->default('unpaid');
            $table->double('total')->default(0);
            $table->string('credit')->nullable();
            $table->string('credit_vat')->nullable();
            $table->string('debit')->nullable();
            $table->string('debit_vat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_returns');
    }
};
