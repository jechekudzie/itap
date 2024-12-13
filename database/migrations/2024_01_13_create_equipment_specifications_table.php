<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment_specifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipment_id');
            $table->unsignedBigInteger('specification_template_id');
            $table->text('value')->nullable();
            $table->timestamps();

            $table->unique(
                ['equipment_id', 'specification_template_id'],
                'equipment_spec_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment_specifications');
    }
}; 