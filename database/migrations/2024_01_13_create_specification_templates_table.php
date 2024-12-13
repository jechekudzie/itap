<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specification_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipment_category_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('field_type'); // text, number, select, radio, checkbox, etc.
            $table->boolean('is_required')->default(false);
            $table->boolean('allow_multiple')->default(false);
            $table->text('default_value')->nullable();
            $table->text('options')->nullable(); // For select/radio/checkbox fields, stored as JSON
            $table->string('validation_rules')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('equipment_category_id')
                  ->references('id')
                  ->on('equipment_categories')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specification_templates');
    }
}; 