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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('equipment_category_id');
            $table->string('status')->default('available');
            $table->string('serial_number')->nullable()->unique();
            $table->string('asset_number')->nullable()->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('equipment_category_id')
                  ->references('id')
                  ->on('equipment_categories')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
}; 