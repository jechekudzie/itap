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
        Schema::create('service_package_line_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_package_id');
            $table->unsignedBigInteger('line_item_id');
            $table->integer('quantity')->default(0);
            $table->boolean('on_discount')->default(0);
            $table->double('discount',10,2)->nullable();
            $table->text('notes')->nullable(); // Any additional notes or customizations for the line item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_package_line_items');
    }
};
