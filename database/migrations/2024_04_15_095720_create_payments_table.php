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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('booking_id');
            $table->decimal('amount_invoiced',8,2)->nullable();
            $table->decimal('amount_paid',8,2)->nullable();
            $table->decimal('balance',8,2)->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->string('online_reference')->nullable();
            $table->string('reference')->nullable();
            $table->string('pop')->nullable();
            $table->string('zoho')->nullable();
            $table->unsignedBigInteger('payment_status_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
