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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('service_category_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('service_package_id');
            $table->unsignedBigInteger('organisation_id')->nullable(); //branch to handle the booking
            $table->double('amount_invoiced',8,2)->nullable();
            $table->double('additional_cost',8,2)->nullable();
            $table->boolean('terms')->default(0);
            $table->boolean('is_confirmed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
